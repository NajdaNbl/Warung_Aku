@extends('admin.layouts.admin')

@section('title', 'Manajemen Produk - Warung Aku')
@section('page_title', 'Manajemen Produk')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <p class="text-sm text-gray-500">Total {{ $products->total() }} produk</p>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2.5 bg-[#1B4332] text-white text-sm font-medium rounded-xl hover:bg-[#2D6A4F] transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Produk
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Produk</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Kategori</th>
                    <th class="text-right py-3 px-4 text-gray-400 font-medium">Harga</th>
                    <th class="text-right py-3 px-4 text-gray-400 font-medium">Stok</th>
                    <th class="text-center py-3 px-4 text-gray-400 font-medium">Status</th>
                    <th class="text-center py-3 px-4 text-gray-400 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-b border-gray-50 hover:bg-gray-50">
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden shrink-0">
                                    <img src="{{ $product->image ?: 'https://via.placeholder.com/80' }}" alt="" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-medium text-gray-700">{{ $product->name }}</p>
                                    <div class="flex space-x-2 mt-1">
                                        @if($product->is_best_seller)<span class="text-xs bg-[#D4A373]/10 text-[#D4A373] px-2 py-0.5 rounded-full">Terlaris</span>@endif
                                        @if($product->is_new_arrival)<span class="text-xs bg-orange-50 text-orange-500 px-2 py-0.5 rounded-full">Baru</span>@endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $product->category->name ?? '-' }}</td>
                        <td class="py-3 px-4 text-right font-medium text-[#1B4332]">{{ $product->price_formatted }}</td>
                        <td class="py-3 px-4 text-right">{{ $product->stock }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-gray-400 hover:text-[#1B4332] transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="py-12 text-center text-gray-400">Belum ada produk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6">
        {{ $products->links() }}
    </div>
</div>
@endsection
