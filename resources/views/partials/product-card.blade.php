<div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
    <div class="relative overflow-hidden aspect-square">
        <img src="{{ $product->image ?: 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy">
        <div class="absolute top-3 left-3 flex flex-col gap-2">
            @if($product->is_best_seller)
                <span class="bg-[#D4A373] text-white text-xs font-bold px-3 py-1 rounded-full shadow">Terlaris</span>
            @endif
            @if($product->is_new_arrival)
                <span class="bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Baru</span>
            @endif
        </div>
        @if($product->stock < 1)
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-bold">Stok Habis</span>
            </div>
        @endif
    </div>
    <div class="p-4">
        <p class="text-xs text-gray-400 mb-1">{{ $product->category->name ?? 'Kategori' }}</p>
        <h3 class="font-semibold text-[#1B4332] text-sm mb-2 line-clamp-2">{{ $product->name }}</h3>
        <p class="text-lg font-bold text-[#D4A373] mb-4">{{ $product->price_formatted }}</p>
        <div class="flex gap-2">
            <a href="{{ route('products.show', $product->slug) }}" class="flex-1 text-center text-sm font-medium text-gray-600 border border-gray-200 rounded-lg py-2 hover:bg-gray-50 transition-colors">
                Detail
            </a>
            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full text-sm font-medium text-white rounded-lg py-2 transition-all duration-300 hover:opacity-90" style="background-color: #1B4332;">
                        + Keranjang
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
