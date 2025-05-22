@extends('layouts.dashboard-layout')

@section('content')
<style>
    .dashboard-container {
        display: flex;
        gap: 10px; /* Lebih rapat */
        overflow-x: auto;
        padding: 10px;
    }

    .dashboard-card {
        flex: 3 0 220px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-left: 7px solid;
        border-radius: 8px;
        padding: 16px;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        min-height: 110px;
        transition: transform 0.2s ease-in-out;
    }

    .dashboard-card:hover {
        transform: scale(1.02);
    }

    .dashboard-icon {
        font-size: 31px;
        color: #ccc;
    }

    .fw-bold {
        font-weight: 700;
    }
</style>

<div class="dashboard-container">

    <!-- Barang -->
    <div class="dashboard-card" style="border-color: #6f42c1;">
        <div>
            <div class="text-uppercase fw-bold" style="color: #6f42c1;">Barang</div>
            <div class="fs-3 fw-bold">{{ $jumlahBarang }}</div>
            <div class="text-muted">Jumlah Barang</div>
        </div>
        <div class="dashboard-icon">📦</div>
    </div>

    <!-- Kategori -->
    <div class="dashboard-card" style="border-color: #20c997;">
        <div>
            <div class="text-uppercase fw-bold" style="color: #20c997;">Kategori</div>
            <div class="fs-3 fw-bold">{{ $jumlahKategori }}</div>
            <div class="text-muted">Jenis Kategori</div>
        </div>
        <div class="dashboard-icon">🧾</div>
    </div>

    <!-- Peminjaman -->
    <div class="dashboard-card" style="border-color: #0dcaf0;">
        <div>
            <div class="text-uppercase fw-bold" style="color: #0dcaf0;">Peminjaman</div>
            <div class="fs-3 fw-bold">{{ $jumlahPeminjaman }}</div>
            <div class="text-muted">Peminjam</div>
        </div>
        <div class="dashboard-icon">🔄</div>
    </div>

    <!-- User -->
    <div class="dashboard-card" style="border-color: #ffc107;">
        <div>
            <div class="text-uppercase fw-bold" style="color: #ffc107;">User</div>
            <div class="fs-3 fw-bold">{{ $jumlahUser }}</div>
            <div class="text-muted">Pengguna</div>
        </div>
        <div class="dashboard-icon">👤</div>
    </div>  
</div>
@endsection
