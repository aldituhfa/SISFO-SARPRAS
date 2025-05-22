@extends('layouts.dashboard-layout')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow-md">
    <!-- Judul dan Icon -->
    <div class="mb-4">
        <h2 class="text-3xl font-bold text-black flex items-center gap-2">
            <svg class="w-7 h-7 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 7h5l2-2h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3z" />
            </svg>
            Kategori Barang
        </h2>
    </div>

    <!-- Search Bar -->
    <form action="{{ route('kategori.index') }}" method="GET" class="flex gap-2 mb-6">
        <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}"
            class="w-40 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">Cari</button>
    </form>

    <!-- Form Tambah -->
    <form action="{{ route('kategori.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="flex gap-2">
            <input type="text" name="nama_kategori"
                class="flex-grow px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                placeholder="Nama kategori..." required />
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">+ Tambah</button>
        </div>
    </form>

    <!-- List Kategori -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto text-left border border-gray-300 rounded">
            <thead>
                <tr class="bg-gray-100 text-black">
                    <th class="px-4 py-2 border">Nama Kategori</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $k)
                <tr class="hover:bg-gray-50 text-black">
                    <td class="px-4 py-2 border">{{ $k->nama_kategori }}</td>
                    <td class="px-4 py-2 border">
                        <form action="{{ route('kategori.destroy', $k->nama_kategori) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center py-4 text-gray-500">Belum ada kategori ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
