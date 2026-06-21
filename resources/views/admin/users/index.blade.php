@extends('admin.layouts.admin')

@section('title', 'Manajemen Pengguna - Warung Aku')
@section('page_title', 'Manajemen Pengguna')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <p class="text-sm text-gray-500">Total {{ $users->total() }} pengguna</p>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2.5 bg-[#1B4332] text-white text-sm font-medium rounded-xl hover:bg-[#2D6A4F] transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Pengguna
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Nama</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Username</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Email</th>
                    <th class="text-center py-3 px-4 text-gray-400 font-medium">Role</th>
                    <th class="text-center py-3 px-4 text-gray-400 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b border-gray-50 hover:bg-gray-50">
                        <td class="py-3 px-4 font-medium text-gray-700">{{ $user->name }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $user->username ?? '-' }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $user->email }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $user->is_admin ? 'bg-[#1B4332]/10 text-[#1B4332]' : 'bg-gray-100 text-gray-500' }}">
                                {{ $user->is_admin ? 'Admin' : 'User' }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-gray-400 hover:text-[#1B4332] transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-12 text-center text-gray-400">Belum ada pengguna</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
