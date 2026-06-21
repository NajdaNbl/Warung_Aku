@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin - Warung Aku')
@section('page_title', 'Dashboard')

@section('content')
@php
    $statusColors = [
        'pending' => 'bg-yellow-50 text-yellow-600',
        'processed' => 'bg-blue-50 text-blue-600',
        'completed' => 'bg-green-50 text-green-600',
        'cancelled' => 'bg-red-50 text-red-600',
    ];
    $statusLabels = [
        'pending' => 'Pending',
        'processed' => 'Diproses',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
    ];
@endphp

{{-- Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400 mb-1">Total Produk</p>
                <p class="text-3xl font-bold text-[#1B4332]">{{ $totalProducts }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $activeProducts }} aktif</p>
            </div>
            <div class="w-12 h-12 bg-[#EDE0D4] rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400 mb-1">Total Kategori</p>
                <p class="text-3xl font-bold text-[#1B4332]">{{ $totalCategories }}</p>
            </div>
            <div class="w-12 h-12 bg-[#EDE0D4] rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400 mb-1">Total Pesanan</p>
                <p class="text-3xl font-bold text-[#1B4332]">{{ $totalOrders }}</p>
            </div>
            <div class="w-12 h-12 bg-[#EDE0D4] rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400 mb-1">Pesanan Hari Ini</p>
                <p class="text-3xl font-bold text-[#1B4332]">{{ $todayOrders }}</p>
                <p class="text-xs text-gray-400 mt-1">Rp{{ number_format($todayRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-[#EDE0D4] rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>
    </div>
</div>

{{-- Revenue + Stats + Low Stock --}}
<div class="grid lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-400 mb-1">Total Pendapatan</p>
        <p class="text-2xl font-bold text-[#D4A373]">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <p class="text-xs text-gray-400 mt-1">Pendapatan 7 hari terakhir:</p>
        <div class="mt-3 space-y-1">
            @foreach(range(6, 0) as $day)
                @php
                    $date = now()->subDays($day)->format('Y-m-d');
                    $rev = $revenueByDay[$date]->revenue ?? 0;
                    $label = now()->subDays($day)->format('D');
                @endphp
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-500 w-8">{{ $label }}</span>
                    <div class="flex-1 mx-2">
                        <div class="bg-gray-100 rounded-full h-2">
                            <div class="bg-[#D4A373] rounded-full h-2" style="width: {{ $totalRevenue > 0 ? ($rev / $totalRevenue) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <span class="text-gray-600 font-medium w-16 text-right">Rp{{ number_format($rev, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h3 class="font-semibold text-[#1B4332] mb-4">Status Pesanan</h3>
        <div class="space-y-3">
            @foreach(['pending', 'processed', 'completed', 'cancelled'] as $status)
                <div class="flex items-center justify-between p-3 rounded-xl {{ in_array($status, ['pending', 'processed']) ? 'bg-gray-50' : '' }}">
                    <span class="text-sm font-medium text-gray-600">{{ $statusLabels[$status] }}</span>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-bold text-[#1B4332]">{{ $orderStats[$status] }}</span>
                        @if($totalOrders > 0)
                            <span class="text-xs text-gray-400">({{ round(($orderStats[$status] / max($totalOrders, 1)) * 100) }}%)</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if($lowStockProducts->isNotEmpty())
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h3 class="font-semibold text-[#1B4332] mb-4 flex items-center space-x-2">
            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg>
            <span>Stok Menipis</span>
        </h3>
        <div class="space-y-2">
            @foreach($lowStockProducts as $product)
                <div class="flex items-center justify-between p-2 bg-orange-50 rounded-lg">
                    <span class="text-sm font-medium text-gray-700">{{ $product->name }}</span>
                    <span class="text-sm font-bold text-orange-600">Sisa {{ $product->stock }}</span>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

{{-- Best Sellers + Recent Orders --}}
<div class="grid lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-lg font-semibold text-[#1B4332] mb-6">Produk Terlaris</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">Produk</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">Kategori</th>
                        <th class="text-right py-3 px-4 text-gray-400 font-medium">Harga</th>
                        <th class="text-right py-3 px-4 text-gray-400 font-medium">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bestSellers as $product)
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden shrink-0">
                                        <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-medium text-gray-700">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-gray-500">{{ $product->category->name ?? '-' }}</td>
                            <td class="py-3 px-4 text-right font-medium text-[#1B4332]">{{ $product->price_formatted }}</td>
                            <td class="py-3 px-4 text-right">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $product->stock > 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                    {{ $product->stock > 0 ? $product->stock : 'Habis' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-8 text-center text-gray-400">Belum ada produk terlaris</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-[#1B4332]">Pesanan Terbaru</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-[#D4A373] hover:underline">Lihat Semua</a>
        </div>
        <div class="space-y-3">
            @forelse($recentOrders as $order)
                <a href="{{ route('admin.orders.show', $order) }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors">
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ $order->customer_name }}</p>
                        <p class="text-xs text-gray-400">{{ $order->total_items }} item • {{ $order->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-[#1B4332]">{{ $order->total_price_formatted }}</p>
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-50 text-gray-600' }}">
                            {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                        </span>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-400 py-8">Belum ada pesanan</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
