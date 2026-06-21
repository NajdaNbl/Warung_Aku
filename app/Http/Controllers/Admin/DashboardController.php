<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();

        $bestSellers = Product::bestSeller()->with('category')->take(5)->get();

        $activeProducts = Product::where('is_active', true)->count();

        $lowStockProducts = Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->with('category')
            ->take(5)
            ->get();

        $todayRevenue = Order::whereDate('created_at', today())->sum('total_price');
        $todayOrders = Order::whereDate('created_at', today())->count();

        $totalRevenue = Order::sum('total_price');

        $revenueByDay = Order::where('created_at', '>=', now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $orderStats = [
            'pending' => Order::where('status', 'pending')->count(),
            'processed' => Order::where('status', 'processed')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        $recentOrders = Order::with('items')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalUsers',
            'activeProducts',
            'bestSellers',
            'lowStockProducts',
            'todayRevenue',
            'todayOrders',
            'totalRevenue',
            'revenueByDay',
            'orderStats',
            'recentOrders'
        ));
    }
}
