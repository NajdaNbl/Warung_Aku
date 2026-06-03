<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $bestSellers = Product::active()->bestSeller()->with('category')->take(8)->get();
        $newArrivals = Product::active()->newArrival()->with('category')->take(8)->get();
        $categories = Category::active()->withCount('activeProducts')->get();

        return view('home', compact('bestSellers', 'newArrivals', 'categories'));
    }
}
