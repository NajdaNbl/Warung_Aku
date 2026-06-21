@extends('layouts.public')

@section('title', 'Keranjang Belanja - Warung Aku')

@section('content')
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-[#1B4332] mb-8">Keranjang Belanja</h1>

        @if(empty($cart))
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" /></svg>
                <p class="text-xl font-medium text-gray-400 mb-2">Keranjang belanja kosong</p>
                <p class="text-gray-400 mb-6">Mulai belanja yuk!</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-3 bg-[#1B4332] text-white font-semibold rounded-xl hover:bg-[#2D6A4F] transition-all duration-300">
                    Belanja Sekarang
                </a>
            </div>
        @else
            <div class="space-y-4">
                @php $grandTotal = 0; @endphp
                @foreach($cart as $id => $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $grandTotal += $subtotal;
                    @endphp
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100 flex flex-col sm:flex-row gap-4 items-start">
                        <div class="w-full sm:w-24 h-24 rounded-xl overflow-hidden bg-gray-100 shrink-0">
                            <img src="{{ $item['image'] ?: 'https://via.placeholder.com/150' }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-[#1B4332]">{{ $item['name'] }}</h3>
                            <p class="text-[#D4A373] font-bold mt-1">{{ 'Rp' . number_format($item['price'], 0, ',', '.') }}</p>
                            <div class="flex items-center justify-between mt-3">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                        <button type="button" onclick="this.parentNode.querySelector('input').stepDown(); this.closest('form').submit();" class="px-3 py-1.5 hover:bg-gray-50 text-gray-500 text-sm">-</button>
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] }}" class="w-12 text-center py-1.5 border-x border-gray-200 outline-none text-sm" readonly>
                                        <button type="button" onclick="this.parentNode.querySelector('input').stepUp(); this.closest('form').submit();" class="px-3 py-1.5 hover:bg-gray-50 text-gray-500 text-sm">+</button>
                                    </div>
                                </form>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-sm text-gray-400">Subtotal</p>
                            <p class="font-bold text-[#1B4332]">{{ 'Rp' . number_format($subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-gray-500">Total Item:</span>
                    <span class="font-semibold text-[#1B4332]">{{ array_sum(array_column($cart, 'quantity')) }} item</span>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <span class="text-lg font-semibold text-gray-700">Total Harga:</span>
                    <span class="text-2xl font-bold text-[#D4A373]">{{ 'Rp' . number_format($grandTotal, 0, ',', '.') }}</span>
                </div>

                <div class="border-t border-gray-100 pt-4 mb-4 space-y-3">
                    <p class="text-sm font-medium text-gray-600">Data Pemesan:</p>

                    @guest
                    <input type="text" form="checkoutForm" name="customer_name" value="{{ old('customer_name') }}" placeholder="Nama lengkap..." required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all text-sm {{ $errors->has('customer_name') ? 'border-red-400' : '' }}">
                    @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <input type="tel" form="checkoutForm" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="No. WhatsApp (contoh: 08123456789)" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all text-sm {{ $errors->has('customer_phone') ? 'border-red-400' : '' }}">
                    @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    @endguest

                    <textarea form="checkoutForm" name="customer_address" rows="2" placeholder="Alamat pengiriman (opsional)..." class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all text-sm">{{ old('customer_address') }}</textarea>
                    @error('customer_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                    <textarea form="checkoutForm" name="notes" rows="2" placeholder="Catatan untuk penjual (opsional)..." class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all text-sm">{{ old('notes') }}</textarea>
                </div>

                <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-[#1B4332] text-white font-bold rounded-xl hover:bg-[#2D6A4F] transition-all duration-300 flex items-center justify-center space-x-2 text-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" /></svg>
                        <span>Checkout via WhatsApp</span>
                    </button>
                </form>
            </div>
        @endif
    </div>
</section>
@endsection
