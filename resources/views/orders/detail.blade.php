@extends('layouts.public')

@section('title', 'Detail Pesanan - Warung Aku')

@section('content')
<section class="py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-[#1B4332] transition-colors mb-6">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            Kembali
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-[#1B4332]">Pesanan #{{ $order->id }}</h2>
                    <p class="text-sm text-gray-400">{{ $order->created_at->format('d F Y H:i') }}</p>
                </div>
                <span class="px-4 py-1.5 rounded-full text-sm font-medium
                    {{ $order->status == 'pending' ? 'bg-yellow-50 text-yellow-600' : '' }}
                    {{ $order->status == 'processed' ? 'bg-blue-50 text-blue-600' : '' }}
                    {{ $order->status == 'completed' ? 'bg-green-50 text-green-600' : '' }}
                    {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-600' : '' }}">
                    {{ $order->status_label }}
                </span>
            </div>

            <div class="border-t border-gray-100 pt-4">
                <h3 class="font-medium text-gray-700 mb-3">Item Pesanan</h3>
                <div class="space-y-3">
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <div>
                                <p class="font-medium text-gray-700">{{ $item->product_name }}</p>
                                <p class="text-sm text-gray-400">{{ $item->quantity }} x {{ 'Rp' . number_format($item->product_price, 0, ',', '.') }}</p>
                            </div>
                            <p class="font-bold text-[#1B4332]">{{ 'Rp' . number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($order->customer_address)
            <div class="border-t border-gray-100 pt-4">
                <h3 class="font-medium text-gray-700 mb-2">Alamat Pengiriman</h3>
                <p class="text-sm text-gray-600">{{ $order->customer_address }}</p>
            </div>
            @endif

            @if($order->notes)
            <div class="border-t border-gray-100 pt-4">
                <h3 class="font-medium text-gray-700 mb-2">Catatan</h3>
                <p class="text-sm text-gray-600">{{ $order->notes }}</p>
            </div>
            @endif

            <div class="border-t border-gray-100 pt-4 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Total Item:</span>
                    <span class="font-semibold">{{ $order->total_items }} item</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold text-gray-700">Total Harga:</span>
                    <span class="text-xl font-bold text-[#D4A373]">{{ $order->total_price_formatted }}</span>
                </div>
            </div>

            @if($order->status == 'completed' || $order->status == 'processed')
            <div class="border-t border-gray-100 pt-4">
                <a href="{{ route('invoice.view', $order) }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-[#1B4332] text-white font-medium rounded-xl hover:bg-[#2D6A4F] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Lihat Invoice
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
