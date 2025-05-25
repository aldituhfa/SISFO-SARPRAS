@extends('layouts.dashboard-layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h1 class="text-center mb-4 fw-bold" style="font-size: 2.5rem;">Data Pengembalian</h1>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle shadow-sm bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;">NO</th>
                            <th>Peminjam</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Kondisi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengembalians as $no => $item)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $item->peminjam }}</td>
                            <td>{{ $item->barang }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') }}</td>
                            <td>{{ $item->kondisi_barang }}</td>
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar" width="70" height="70" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                @if($item->aksi)
                                    <span class="badge bg-success text-capitalize">{{ $item->aksi }}</span>
                                @else
                                    <span class="text-muted">Belum</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status)
                                    <span class="badge bg-info text-capitalize">{{ $item->status }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if(!$item->aksi)
                                <form action="{{ route('pengembalian.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="aksi" class="form-select form-select-sm mb-2" required>
                                        <option value="">-- Pilih Aksi --</option>
                                        <option value="diterima">Diterima</option>
                                        <option value="terlambat">Terlambat</option>
                                        <option value="hilang">Hilang</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary w-100">Proses</button>
                                </form>
                                @else
                                    <span class="text-success fw-bold">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">Belum ada data pengembalian.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
