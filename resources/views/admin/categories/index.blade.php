@extends('admin.layouts.admin')

@section('title', 'Manajemen Kategori - Warung Aku')
@section('page_title', 'Manajemen Kategori')

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
            @csrf
            <h3 class="font-semibold text-[#1B4332]">Tambah Kategori</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kategori</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="w-full py-3 bg-[#1B4332] text-white font-medium rounded-xl hover:bg-[#2D6A4F] transition-colors">Simpan</button>
        </form>
    </div>
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <p class="text-sm text-gray-500">Total {{ $categories->count() }} kategori</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50">
                            <th class="text-left py-3 px-4 text-gray-400 font-medium">Kategori</th>
                            <th class="text-center py-3 px-4 text-gray-400 font-medium">Foto</th>
                            <th class="text-center py-3 px-4 text-gray-400 font-medium">Produk</th>
                            <th class="text-center py-3 px-4 text-gray-400 font-medium">Status</th>
                            <th class="text-center py-3 px-4 text-gray-400 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr class="border-b border-gray-50 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        @if($category->image_url)
                                        <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 shrink-0">
                                            <img src="{{ $category->image_url }}" alt="" class="w-full h-full object-cover">
                                        </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-700">{{ $category->name }}</p>
                                            @if($category->description)
                                                <p class="text-xs text-gray-400 mt-0.5">{{ $category->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if($category->image_url)
                                        <img src="{{ $category->image_url }}" alt="" class="w-10 h-10 rounded-lg object-cover mx-auto">
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center text-gray-500">{{ $category->products_count }}</td>
                                <td class="py-3 px-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                        {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}', {{ $category->is_active }})" class="p-2 text-gray-400 hover:text-[#1B4332] transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </button>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-12 text-center text-gray-400">Belum ada kategori</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4">
        <h3 class="font-semibold text-[#1B4332] mb-4">Edit Kategori</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" id="editName" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="editDescription" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kategori</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none">
            </div>
            <label class="flex items-center space-x-3">
                <input type="checkbox" name="is_active" value="1" id="editActive" class="w-4 h-4 text-[#D4A373] rounded focus:ring-[#D4A373]">
                <span class="text-sm text-gray-700">Aktif</span>
            </label>
            <div class="flex justify-end space-x-3 pt-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-sm text-gray-400 hover:text-gray-600">Batal</button>
                <button type="submit" class="px-6 py-2 bg-[#1B4332] text-white text-sm font-medium rounded-xl hover:bg-[#2D6A4F] transition-colors">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function editCategory(id, name, description, isActive) {
        document.getElementById('editForm').action = '/admin/categories/' + id;
        document.getElementById('editName').value = name;
        document.getElementById('editDescription').value = description;
        document.getElementById('editActive').checked = isActive;
        document.getElementById('editModal').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });
</script>
@endpush
