@extends('layouts.public')

@section('title', $product->name . ' - Warung Aku')
@section('meta_description', Str::limit($product->description, 160))

@section('content')
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-[#1B4332] transition-colors">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-[#1B4332] transition-colors">Produk</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600">{{ $product->name }}</span>
        </nav>

        <div class="grid md:grid-cols-2 gap-10">
            <div class="relative">
                <div class="aspect-square rounded-2xl overflow-hidden bg-gray-100 shadow-lg">
                    <img src="{{ $product->image ?: 'https://via.placeholder.com/600' }}" alt="{{ $product->name }}" class="w-full h-full object-cover" id="mainImage">
                </div>
                <div class="absolute top-4 left-4 flex flex-col gap-2">
                    @if($product->is_best_seller)
                        <span class="bg-[#D4A373] text-white text-sm font-bold px-4 py-1.5 rounded-full shadow">Terlaris</span>
                    @endif
                    @if($product->is_new_arrival)
                        <span class="bg-orange-500 text-white text-sm font-bold px-4 py-1.5 rounded-full shadow">Baru</span>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <p class="text-sm text-[#D4A373] font-medium mb-2">{{ $product->category->name ?? 'Kategori' }}</p>
                    <h1 class="text-3xl font-bold text-[#1B4332]">{{ $product->name }}</h1>
                </div>

                <div class="flex items-baseline gap-4">
                    <span class="text-3xl font-bold text-[#D4A373]">{{ $product->price_formatted }}</span>
                </div>

                <div class="flex items-center space-x-4 text-sm">
                    <div class="flex items-center space-x-1">
                        <svg class="w-5 h-5 {{ $product->stock > 0 ? 'text-green-500' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }} font-medium">{{ $product->stock_status }}</span>
                    </div>
                </div>

                @if($product->description)
                    <div>
                        <h3 class="font-semibold text-[#1B4332] mb-2">Deskripsi</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                    </div>
                @endif

                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <label class="text-sm font-medium text-gray-600">Jumlah:</label>
                            <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden">
                                <button type="button" onclick="decrementQty()" class="px-4 py-2 hover:bg-gray-50 transition-colors text-gray-500">-</button>
                                <input type="number" name="quantity" id="qtyInput" value="1" min="1" max="{{ $product->stock }}" class="w-16 text-center py-2 border-x border-gray-200 outline-none text-sm font-medium" readonly>
                                <button type="button" onclick="incrementQty({{ $product->stock }})" class="px-4 py-2 hover:bg-gray-50 transition-colors text-gray-500">+</button>
                            </div>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-[#1B4332] text-white font-semibold rounded-xl hover:bg-[#2D6A4F] transition-all duration-300 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" /></svg>
                            <span>Tambah ke Keranjang</span>
                        </button>
                    </form>
                @else
                    <button disabled class="w-full sm:w-auto px-8 py-4 bg-gray-300 text-gray-500 font-semibold rounded-xl cursor-not-allowed">
                        Stok Habis
                    </button>
                @endif
            </div>
        </div>

        @if($relatedProducts->isNotEmpty())
            <section class="mt-16">
                <h2 class="text-2xl font-bold text-[#1B4332] mb-8">Produk Terkait</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        @include('partials.product-card', ['product' => $related])
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    function decrementQty() {
        const input = document.getElementById('qtyInput');
        const val = parseInt(input.value);
        if (val > 1) input.value = val - 1;
    }
    function incrementQty(max) {
        const input = document.getElementById('qtyInput');
        const val = parseInt(input.value);
        if (val < max) input.value = val + 1;
    }
</script>
@endpush
