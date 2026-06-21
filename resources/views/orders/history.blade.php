@extends('layouts.public')

@section('title', 'Pesanan Saya - Warung Aku')

@section('content')
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-[#1B4332] mb-8">Pesanan Saya</h1>

        @if($orders->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                <p class="text-xl font-medium text-gray-400 mb-2">Belum ada pesanan</p>
                <p class="text-gray-400 mb-6">Ayo mulai belanja!</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-3 bg-[#1B4332] text-white font-semibold rounded-xl hover:bg-[#2D6A4F] transition-all duration-300">
                    Belanja Sekarang
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order) }}" class="block bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-sm text-gray-400">No. Pesanan</span>
                                <p class="font-semibold text-[#1B4332]">#{{ $order->id }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                {{ $order->status == 'pending' ? 'bg-yellow-50 text-yellow-600' : '' }}
                                {{ $order->status == 'processed' ? 'bg-blue-50 text-blue-600' : '' }}
                                {{ $order->status == 'completed' ? 'bg-green-50 text-green-600' : '' }}
                                {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-600' : '' }}">
                                {{ $order->status_label }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">{{ $order->total_items }} item • {{ $order->created_at->format('d M Y H:i') }}</span>
                            <span class="font-bold text-[#D4A373]">{{ $order->total_price_formatted }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
