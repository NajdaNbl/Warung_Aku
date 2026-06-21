<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        $rules = [
            'customer_address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ];

        if (!auth()->check()) {
            $rules['customer_name'] = 'required|string|max:255';
            $rules['customer_phone'] = 'required|string|max:20';
        }

        $validated = $request->validate($rules);

        if (auth()->check()) {
            $customerName = auth()->user()->name;
            $customerPhone = auth()->user()->phone ?? ($request->customer_phone ?? '');
        } else {
            $customerName = $validated['customer_name'];
            $customerPhone = $validated['customer_phone'];
        }

        $customerAddress = $request->customer_address ?? '';

        $storeName = Setting::getValue('store_name', 'Warung Aku');

        $totalItems = 0;
        $totalPrice = 0;

        $message = "Halo *$storeName*, saya ingin memesan:\n\n";

        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $totalItems += $item['quantity'];
            $totalPrice += $subtotal;
            $message .= "▪️ " . $item['name'] . " x" . $item['quantity'] . " = Rp" . number_format($subtotal, 0, ',', '.') . "\n";
        }

        $message .= "\n*Total Item:* " . $totalItems;
        $message .= "\n*Total Harga:* Rp" . number_format($totalPrice, 0, ',', '.');
        $message .= "\n*Nama:* " . $customerName;
        $message .= "\n*Telepon:* " . $customerPhone;

        if ($customerAddress) {
            $message .= "\n*Alamat:* " . $customerAddress;
        }

        if ($request->notes) {
            $message .= "\n*Catatan:* " . $request->notes;
        }

        $message .= "\n\nTerima kasih.";

        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => $customerName,
            'customer_phone' => $customerPhone,
            'customer_address' => $customerAddress,
            'total_price' => $totalPrice,
            'total_items' => $totalItems,
            'notes' => $request->notes,
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

        $notifMessage = "*Pesanan Baru!*\n\n"
            . "No. Pesanan: #{$order->id}\n"
            . "Pelanggan: {$customerName}\n"
            . "Total: Rp" . number_format($totalPrice, 0, ',', '.') . "\n"
            . "Item: {$totalItems} produk\n\n"
            . "Silakan cek di admin panel.";

        WhatsAppService::notifyAdmin($notifMessage);

        $waNumber = Setting::getValue('wa_number') ?? '621235331414';
        $encodedMessage = urlencode($message);
        $waUrl = "https://wa.me/{$waNumber}?text={$encodedMessage}";

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
