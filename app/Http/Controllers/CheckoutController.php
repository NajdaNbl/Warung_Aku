<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        $customerName = auth()->check() ? auth()->user()->name : ($request->customer_name ?? 'Pelanggan');
        $customerPhone = auth()->check()
            ? (auth()->user()->phone ?? $request->customer_phone ?? '')
            : ($request->customer_phone ?? '');

        $totalItems = 0;
        $totalPrice = 0;

        $message = "Halo Warung Aku, saya ingin memesan:\n\n";

        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $totalItems += $item['quantity'];
            $totalPrice += $subtotal;
            $message .= "* " . $item['name'] . " x" . $item['quantity'] . " = Rp" . number_format($subtotal, 0, ',', '.') . "\n";
        }

        $message .= "\nTotal Item: " . $totalItems;
        $message .= "\nTotal Harga: Rp" . number_format($totalPrice, 0, ',', '.');
        $message .= "\n\nTerima kasih.";

        $storeName = Setting::getValue('store_name', 'Warung Aku');

        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => $customerName,
            'customer_phone' => $customerPhone,
            'total_price' => $totalPrice,
            'total_items' => $totalItems,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            $product = Product::find($item['id']);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        session()->forget('cart');

        $waNumber = Setting::getValue('wa_number') ?? '621235331414';
        $encodedMessage = urlencode($message);
        $waUrl = "https://wa.me/{$waNumber}?text={$encodedMessage}";

        if ($request->has('notes') && $request->notes) {
            $waUrl .= urlencode("\n\nCatatan: " . $request->notes);
        }

        return redirect()->route('checkout.success', $order)->with('wa_url', $waUrl);
    }

    public function success(Order $order)
    {
        $waUrl = session('wa_url');
        if (!$waUrl) {
            return redirect()->route('home');
        }

        $order->load('items');
        return view('checkout.success', compact('order', 'waUrl'));
    }
}
