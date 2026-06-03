@extends('admin.layouts.admin')

@section('title', 'Detail Pesanan - Warung Aku')
@section('page_title', 'Detail Pesanan')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-[#1B4332] transition-colors mb-6">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        Kembali
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-[#1B4332]">Pesanan #{{ $order->id }}</h2>
                <p class="text-sm text-gray-400">{{ $order->created_at->format('d F Y H:i') }}</p>
            </div>
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
            <span class="px-4 py-1.5 rounded-full text-sm font-medium {{ $statusColors[$order->status] ?? 'bg-gray-50 text-gray-600' }}">
                {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
            </span>
        </div>

        {{-- Update Status --}}
        <div class="border-t border-gray-100 pt-4">
            <h3 class="font-medium text-gray-700 mb-3">Update Status</h3>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="flex flex-wrap gap-3">
                @csrf
                @method('PATCH')
                <select name="status" class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processed" {{ $order->status == 'processed' ? 'selected' : '' }}>Diproses</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <button type="submit" class="px-6 py-2.5 bg-[#1B4332] text-white text-sm font-medium rounded-xl hover:bg-[#2D6A4F] transition-colors">
                    Simpan
                </button>
                <button type="button" onclick="window.print()" class="px-6 py-2.5 bg-gray-100 text-gray-600 text-sm font-medium rounded-xl hover:bg-gray-200 transition-colors">
                    Cetak Struk
                </button>
            </form>
        </div>

        <div class="border-t border-gray-100 pt-4">
            <h3 class="font-medium text-gray-700 mb-3">Data Pelanggan</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-400">Nama:</span>
                    <p class="font-medium text-gray-700">{{ $order->customer_name }}</p>
                </div>
                @if($order->customer_phone)
                <div>
                    <span class="text-gray-400">Telepon:</span>
                    <p class="font-medium text-gray-700">{{ $order->customer_phone }}</p>
                </div>
                @endif
            </div>
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

        <div class="border-t border-gray-100 pt-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-gray-500">Total Item:</span>
                <span class="font-semibold">{{ $order->total_items }} item</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-lg font-semibold text-gray-700">Total Harga:</span>
                <span class="text-xl font-bold text-[#D4A373]">{{ $order->total_price_formatted }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
@media print {
    body { background: white; }
    aside, header, .sidebar, .no-print { display: none !important; }
    main { margin: 0; padding: 20px; }
    .max-w-3xl { max-width: 100%; }
}
</style>
@endpush
