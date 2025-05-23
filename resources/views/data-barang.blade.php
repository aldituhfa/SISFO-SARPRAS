@extends('layouts.dashboard-layout')

@section('content')
<div class="mt-10">
    @if(request('form') == 'tambah')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">➕ Tambah Barang</h1>

    <form method="POST" action="{{ route('data-barang.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="nama_barang" placeholder="Nama Barang" class="border border-gray-300 px-4 py-2 rounded" required>
            <select name="kategori_id" class="border border-gray-300 px-4 py-2 rounded" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
            <input type="number" name="stok" placeholder="Stok" class="border border-gray-300 px-4 py-2 rounded" required>
            <input type="text" name="satuan" placeholder="Satuan" class="border border-gray-300 px-4 py-2 rounded" required>
            <input type="text" name="lokasi" placeholder="Lokasi" class="border border-gray-300 px-4 py-2 rounded" required>
            <input type="file" name="gambar" class="border border-gray-300 px-4 py-2 rounded">
        </div>
        <div class="mt-4 flex gap-4">
            <a href="{{ route('data-barang') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded shadow">Kembali</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">Simpan</button>
        </div>
    </form>

    @else
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📦 Data Barang</h1>

    <!-- Search & Tambah -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <form method="GET" action="{{ route('data-barang') }}" class="flex">
            <input type="text" name="search" value="{{ $keyword }}" placeholder="🔍 Cari barang..."
                class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md transition">Cari</button>
        </form>
        <a href="{{ route('data-barang', ['form' => 'tambah']) }}"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow transition">
            + Tambah Barang
        </a>
    </div>

    <!-- Tabel -->
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto text-sm text-left">
            <thead>
                <tr>
                    <th class="px-4 py-3">NO</th>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3">Satuan</th>
                    <th class="px-4 py-3">Lokasi</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barangs as $barang)
                <tr>
                    <td class="px-4 py-2">{{ $barangs->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-2">
                        @if ($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar" width="100">
                        @else
                        <p>Tidak ada gambar</p>
                        @endif

                    </td>
                    <td class="px-4 py-2">{{ $barang->nama_barang }}</td>
                    <td class="px-4 py-2">{{ $barang->kategori->nama_kategori }}</td>
                    <td class="px-4 py-2">{{ $barang->stok }}</td>
                    <td class="px-4 py-2">{{ $barang->satuan }}</td>
                    <td class="px-4 py-2">{{ $barang->lokasi }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('data-barang.edit', $barang->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('data-barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">Tidak ada data ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $barangs->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>
@endsection