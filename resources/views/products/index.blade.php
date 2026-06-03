@extends('layouts.public')

@section('title', 'Produk - Warung Aku')

@section('content')
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-[#1B4332] mb-4">Semua Produk</h1>
            <p class="text-gray-500">Temukan produk yang Anda butuhkan</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-8">
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
                </div>
                <div class="sm:w-48">
                    <select name="category" onchange="this.form.submit()" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none bg-white transition-all">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if(request('search') || request('category'))
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-3 border border-gray-200 rounded-xl text-gray-500 hover:bg-gray-50 transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                @include('partials.product-card', ['product' => $product])
            @empty
                <div class="col-span-full text-center py-16">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                    <p class="text-gray-400 text-lg font-medium">Produk tidak ditemukan</p>
                    <p class="text-gray-400 text-sm mt-2">Coba gunakan kata kunci lain</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection
