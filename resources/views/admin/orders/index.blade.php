@extends('admin.layouts.admin')

@section('title', 'Manajemen Pesanan - Warung Aku')
@section('page_title', 'Manajemen Pesanan')

@section('content')
<div class="grid lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-400 mb-1">Total Pesanan</p>
        <p class="text-2xl font-bold text-[#1B4332]">{{ $orders->total() }}</p>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-400 mb-1">Total Pendapatan</p>
        <p class="text-2xl font-bold text-[#D4A373]">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6">
    <div class="p-4 border-b border-gray-100">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="text-xs text-gray-400 mb-1 block">Status</label>
                <select name="status" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Diproses</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <div>
                <label class="text-xs text-gray-400 mb-1 block">Dari Tanggal</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none">
            </div>
            <div>
                <label class="text-xs text-gray-400 mb-1 block">Sampai Tanggal</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none">
            </div>
            <button type="submit" class="px-4 py-2 bg-[#1B4332] text-white text-sm font-medium rounded-lg hover:bg-[#2D6A4F] transition-colors">Filter</button>
            @if(request('status') || request('date_from') || request('date_to'))
                <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700 border border-gray-200 rounded-lg">Reset</a>
            @endif
        </form>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-[#1B4332]">Riwayat Pesanan</h3>
            <a href="{{ route('admin.orders.export', request()->query()) }}" class="inline-flex items-center px-3 py-1.5 bg-[#1B4332] text-white text-xs font-medium rounded-lg hover:bg-[#2D6A4F] transition-colors">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Export CSV
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="text-left py-3 px-4 text-gray-400 font-medium">Pelanggan</th>
                        <th class="text-right py-3 px-4 text-gray-400 font-medium">Total</th>
                        <th class="text-center py-3 px-4 text-gray-400 font-medium">Item</th>
                        <th class="text-center py-3 px-4 text-gray-400 font-medium">Status</th>
                        <th class="text-right py-3 px-4 text-gray-400 font-medium">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 cursor-pointer" onclick="window.location='{{ route('admin.orders.show', $order) }}'">
                            <td class="py-3 px-4 font-medium text-gray-700">{{ $order->customer_name }}</td>
                            <td class="py-3 px-4 text-right font-medium text-[#1B4332]">{{ $order->total_price_formatted }}</td>
                            <td class="py-3 px-4 text-center text-gray-500">{{ $order->total_items }}</td>
                            <td class="py-3 px-4 text-center">
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
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-50 text-gray-600' }}">
                                    {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right text-gray-400 text-xs">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-12 text-center text-gray-400">Belum ada pesanan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6">
            {{ $orders->links() }}
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="font-semibold text-[#1B4332]">Produk Paling Sering Dipesan</h3>
        </div>
        <div class="p-4 space-y-3">
            @forelse($topProducts as $item)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                    <span class="text-sm font-medium text-gray-700">{{ $item->product_name }}</span>
                    <span class="text-sm font-bold text-[#1B4332]">{{ $item->total_qty }}x</span>
                </div>
            @empty
                <p class="text-center text-gray-400 py-8">Belum ada data</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
