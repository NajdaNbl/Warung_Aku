@extends('admin.layouts.admin')

@section('title', 'Pengaturan Warung - Warung Aku')
@section('page_title', 'Pengaturan Warung')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Warung</label>
            <input type="text" name="store_name" value="{{ old('store_name', $settings['store_name']) }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
            <input type="text" name="wa_number" value="{{ old('wa_number', $settings['wa_number']) }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
            <p class="text-xs text-gray-400 mt-1">Format: 62xxx (tanpa + dan spasi)</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
            <textarea name="address" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">{{ old('address', $settings['address']) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
            <input type="text" name="operational_hours" value="{{ old('operational_hours', $settings['operational_hours']) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Warung</label>
            <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">{{ old('description', $settings['description']) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email Admin</label>
            <input type="email" name="admin_email" value="{{ old('admin_email', $settings['admin_email']) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
            <p class="text-xs text-gray-400 mt-1">Hanya pengguna dengan email ini yang bisa mengakses halaman admin.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
            <input type="file" name="logo" accept="image/*" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Banner</label>
            <input type="file" name="banner" accept="image/*" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#D4A373] focus:border-transparent outline-none transition-all">
        </div>
        <div class="pt-4 border-t border-gray-100">
            <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#1B4332] text-white font-medium rounded-xl hover:bg-[#2D6A4F] transition-colors">Simpan Pengaturan</button>
        </div>
    </form>
</div>
@endsection
