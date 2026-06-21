@extends('admin.layouts.admin')

@section('title', 'Edit Produk - Warung Aku')
@section('page_title', 'Edit Produk')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
            <select name="category_id" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none bg-white transition-all">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>
            @if($product->image)
                <div class="mb-3">
                    <img src="{{ $product->image_url }}" alt="" class="w-24 h-24 rounded-lg object-cover border">
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <label class="flex items-center space-x-3">
                <input type="checkbox" name="is_best_seller" value="1" {{ old('is_best_seller', $product->is_best_seller) ? 'checked' : '' }} class="w-4 h-4 text-[#D4A373] rounded focus:ring-[#D4A373]">
                <span class="text-sm text-gray-700">Produk Terlaris</span>
            </label>
            <label class="flex items-center space-x-3">
                <input type="checkbox" name="is_new_arrival" value="1" {{ old('is_new_arrival', $product->is_new_arrival) ? 'checked' : '' }} class="w-4 h-4 text-[#D4A373] rounded focus:ring-[#D4A373]">
                <span class="text-sm text-gray-700">Produk Baru</span>
            </label>
        </div>
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-3 bg-[#1B4332] text-white font-medium rounded-xl hover:bg-[#2D6A4F] transition-colors">Update Produk</button>
        </div>
    </form>
</div>
@endsection
