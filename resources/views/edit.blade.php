@extends('layouts.dashboard-layout')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Edit Data Barang</h1>
        <a href="{{ route('data-barang') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
    </div>

    <form action="{{ route('data-barang.update', $barang->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="id_barang" class="block">Kode</label>
            <input type="text" id="id_barang" name="id_barang" value="{{ $barang->id_barang }}" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label for="nama_barang" class="block">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label for="kategori_id" class="block">Kategori</label>
            <select id="kategori_id" name="kategori_id" class="w-full p-2 border rounded" required>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kategori->id == $barang->kategori_id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="stok" class="block">Stok</label>
            <input type="number" id="stok" name="stok" value="{{ $barang->stok }}" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label for="satuan" class="block">Satuan</label>
            <input type="text" id="satuan" name="satuan" value="{{ $barang->satuan }}" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label for="lokasi" class="block">Lokasi</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ $barang->lokasi }}" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Barang</button>
    </form>
@endsection
