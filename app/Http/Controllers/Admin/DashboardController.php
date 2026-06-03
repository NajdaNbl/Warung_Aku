<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $bestSellers = Product::bestSeller()->with('category')->take(5)->get();
        $lowStockProducts = Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->with('category')
            ->take(5)
            ->get();
        $todayRevenue = Order::whereDate('created_at', today())->sum('total_price');
        $todayOrders = Order::whereDate('created_at', today())->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'bestSellers',
            'lowStockProducts',
            'todayRevenue',
            'todayOrders'
        ));
    }
}
