@extends('layouts.dashboard-layout')


@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Laporan Barang</h2>
    <div class="mb-4">
        <a href="{{ route('laporan.barang.pdf') }}"
            class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mr-2">Export PDF</a>
        <a href="{{ route('laporan.barang.excel') }}"
            class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export Excel</a>
    </div>
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($barangs as $index => $barang)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->nama_barang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->stok }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->satuan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barang->lokasi }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Data barang belum tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection