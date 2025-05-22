@extends('layouts.dashboard-layout')
@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-xl font-semibold mb-4">Laporan Pengembalian</h1>
    <div class="flex justify-end mb-4 space-x-2">
    <a href="{{ route('laporan.pengembalian.excel') }}"
        class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">Export Excel</a>

    <a href="{{ route('laporan.pengembalian.pdf') }}"
        class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">Export PDF</a>
</div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 bg-white shadow rounded-lg">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2 border-b">No</th>
                    <th class="px-4 py-2 border-b">Nama Peminjam</th>
                    <th class="px-4 py-2 border-b">Nama Barang</th>
                    <th class="px-4 py-2 border-b">Jumlah</th>
                    <th class="px-4 py-2 border-b">Tanggal Pinjam</th>
                    <th class="px-4 py-2 border-b">Tanggal Kembali</th>
                    <th class="px-4 py-2 border-b">Kondisi Barang</th>
                    <th class="px-4 py-2 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $index => $data)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $data->nama_peminjam }}</td>
                    <td class="px-4 py-2 border-b">{{ $data->nama_barang }}</td>
                    <td class="px-4 py-2 border-b">{{ $data->jumlah }}</td>
                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($data->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($data->tanggal_kembali)->format('d-m-Y') }}</td>
                    <td class="px-4 py-2 border-b">{{ $data->kondisi_barang }}</td>
                    <td class="px-4 py-2 border-b">
                        @if ($data->aksi)
                            <span class="px-2 py-1 rounded text-sm text-white
                                {{ $data->aksi === 'Dikembalikan' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $data->aksi }}
                            </span>
                        @else
                            <span class="px-2 py-1 rounded text-sm bg-yellow-400 text-white">
                                Pending
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center px-4 py-4 text-gray-500">
                        Tidak ada data pengembalian.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection