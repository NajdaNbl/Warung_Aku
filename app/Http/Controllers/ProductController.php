<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::active()->get();
        $products = Product::active()->with('category');

        if (request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('category')) {
            $products->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        $products = $products->latest()->paginate(12);

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('category')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
