@extends('layouts.dashboard-layout')

@section('content')
<div class="mt-10">
    <h1 class="text-2xl font-bold mb-4">Daftar Peminjaman</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">NO</th>
                    <th class="px-4 py-2">Nama Peminjam</th>
                    <th class="px-4 py-2">Tanggal Pinjam</th>
                    <th class="px-4 py-2">Barang</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjaman as $pinjam)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $peminjaman->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-2">{{ $pinjam->nama_peminjam }}</td>
                    <td class="px-4 py-2">{{ $pinjam->tanggal_pinjam }}</td>
                    <td class="px-4 py-2">{{ $pinjam->barang }}</td>
                    <td class="px-4 py-2">{{ $pinjam->jumlah }}</td>
                    <td class="px-4 py-2">
                        @if($pinjam->status == 'menunggu')
                        <span class="bg-yellow-300 text-yellow-800 px-2 py-1 rounded">Menunggu</span>
                        @elseif($pinjam->status == 'dipinjam')
                        <span class="bg-green-300 text-green-800 px-2 py-1 rounded">Diterima</span>
                        @else
                        <span class="bg-red-300 text-red-800 px-2 py-1 rounded">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if($pinjam->status == 'menunggu')
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.peminjaman.terima', $pinjam->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded" onclick="return confirm('Terima permintaan ini?')">Terima</button>
                            </form>
                            <form action="{{ route('admin.peminjaman.tolak', $pinjam->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded" onclick="return confirm('Tolak permintaan ini?')">Tolak</button>
                            </form>
                        </div>
                        @else
                        <span class="italic text-gray-500">Tidak tersedia</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Belum ada data peminjaman</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $peminjaman->links() }}
    </div>

</div>
@endsection