@extends('layouts.dashboard-layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Laporan Peminjaman</h2>

    <div class="flex justify-end mb-4 gap-2">
        <a href="{{ route('laporan.export.excel') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Export Excel
        </a>
        <a href="{{ route('laporan.export.pdf') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            Export PDF
        </a>
    </div>


    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Peminjam</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Barang</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($laporan as $data)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $data->nama_peminjam }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $data->barang }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $data->jumlah }}</td>
                    <td>
                        @if($data->status == 'Diterima')
                        <span class="badge bg-success">Diterima</span>
                        @elseif($data->status == 'Ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                        @else
                        <span class="badge bg-secondary">{{ $data->status }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center px-6 py-4 text-sm text-gray-500">
                        Tidak ada data laporan peminjaman.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection