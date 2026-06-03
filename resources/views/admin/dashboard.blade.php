@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin - Warung Aku')
@section('page_title', 'Dashboard')

@section('content')
{{-- Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400 mb-1">Total Produk</p>
                <p class="text-3xl font-bold text-[#1B4332]">{{ $totalProducts }}</p>
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
            </div>
            <div class="w-12 h-12 bg-[#EDE0D4] rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-[#D4A373]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>
    </div>
</div>

{{-- Today Revenue + Low Stock --}}
<div class="grid lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-400 mb-1">Pendapatan Hari Ini</p>
        <p class="text-2xl font-bold text-[#D4A373]">Rp{{ number_format($todayRevenue, 0, ',', '.') }}</p>
    </div>

    @if($lowStockProducts->isNotEmpty())
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
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

{{-- Best Sellers --}}
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
                                    <img src="{{ $product->image ?: 'https://via.placeholder.com/80' }}" alt="" class="w-full h-full object-cover">
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
@endsection
