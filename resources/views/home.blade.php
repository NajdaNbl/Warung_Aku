@extends('layouts.public')

@section('title', 'Warung Aku - Belanja Mudah di Warung Aku')

@section('content')
{{-- Hero --}}
<section class="relative bg-gradient-to-br from-[#1B4332] to-[#2D6A4F] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                Belanja Mudah di <span class="text-[#D4A373]">Warung Aku</span>
            </h1>
            <p class="text-lg sm:text-xl text-white/80 mb-8 max-w-lg mx-auto">
                Kebutuhan harian, makanan, minuman, dan produk pilihan dalam satu tempat.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-[#D4A373] text-white font-semibold rounded-xl shadow-lg hover:bg-[#2D6A4F] transition-all duration-300">
                    Belanja Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                </a>
                <a href="#produk-terbaru" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl border border-white/20 hover:bg-white/20 transition-all duration-300">
                    Lihat Produk
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Kategori --}}
<section class="py-16 bg-[#FAF5EB]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-[#1B4332] mb-4">Kategori Produk</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Temukan berbagai kebutuhan Anda dalam kategori berikut</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            @forelse($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group bg-[#FAF5EB] rounded-2xl p-6 text-center hover:shadow-lg hover:bg-white transition-all duration-300 border border-gray-200/50">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full overflow-hidden {{ $category->image_url ? '' : 'bg-gradient-to-br from-[#1B4332] to-[#D4A373] flex items-center justify-center text-white text-2xl font-bold' }} group-hover:scale-110 transition-transform">
                        @if($category->image_url)
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($category->name, 0, 1) }}
                        @endif
                    </div>
                    <h3 class="font-semibold text-[#1B4332] group-hover:text-[#2D6A4F]">{{ $category->name }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $category->active_products_count }} produk</p>
                </a>
            @empty
                <p class="col-span-6 text-center text-gray-400">Belum ada kategori</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Produk Terlaris --}}
@if($bestSellers->isNotEmpty())
<section class="py-16 bg-[#FAF5EB]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-[#1B4332] mb-2">Produk Terlaris</h2>
                <p class="text-gray-500">Paling laris di Warung Aku</p>
            </div>
            <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center text-[#D4A373] font-medium hover:text-[#1B4332] transition-colors">
                Lihat Semua
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($bestSellers as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Produk Terbaru --}}
@if($newArrivals->isNotEmpty())
<section id="produk-terbaru" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-[#1B4332] mb-2">Produk Terbaru</h2>
                <p class="text-gray-500">Baru datang di Warung Aku</p>
            </div>
            <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center text-[#D4A373] font-medium hover:text-[#1B4332] transition-colors">
                Lihat Semua
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($newArrivals as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Tentang --}}
<section id="tentang" class="py-16 bg-[#1B4332]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Tentang Warung Aku</h2>
            <div class="w-20 h-1 bg-[#D4A373] mx-auto mb-6"></div>
            <p class="text-white/80 leading-relaxed mb-6">
                Warung Aku adalah warung sembako sederhana yang menyediakan kebutuhan harian Anda. Dari beras, minyak, gula, kopi, mie, sabun, hingga camilan — semua tersedia dengan harga yang bersahabat.
            </p>
            <p class="text-white/80 leading-relaxed mb-8">
                Cukup pesan melalui website, dan pesanan Anda akan siap. Kami juga melayani pemesanan lewat WhatsApp untuk kemudahan Anda.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-[#D4A373] text-white font-semibold rounded-xl hover:opacity-90 transition-all duration-300">
                    Mulai Belanja
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
