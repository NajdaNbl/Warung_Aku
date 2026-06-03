<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $subtotal = 0;

        foreach ($cart as &$item) {
            $item['subtotal'] = $item['price'] * $item['quantity'];
            $subtotal += $item['subtotal'];
        }

        $total = $subtotal;

        return view('cart.index', compact('cart', 'total', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        if (!$product->is_active || $product->stock < 1) {
            return back()->with('error', 'Produk tidak tersedia.');
        }

        $cart = session()->get('cart', []);
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
            if ($cart[$product->id]['quantity'] > $product->stock) {
                $cart[$product->id]['quantity'] = $product->stock;
            }
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
                'stock' => $product->stock,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, min($request->quantity, $cart[$id]['stock']));
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan');
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));

        return response()->json(['count' => $count]);
    }
}
