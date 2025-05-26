@extends('layouts.dashboard-layout')

@section('content')
<style>
    .dashboard-container {
        display: flex;
        gap: 10px;
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
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
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

    .chart-container {
        margin: 40px 20px;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .custom-table thead {
        background-color: #007BFF;
        color: white;
        text-align: center;
    }

    .custom-table td,
    .custom-table th {
        border: 1px solid #dee2e6 !important;
        /* paksa border tampil */
        text-align: center;
        vertical-align: middle;
    }

    .custom-table {
        border-collapse: collapse;
        /* pastikan border tidak tumpang tindih */
        width: 100%;
    }
</style>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
<div class="bg-white shadow-md py-2 px-7 rounded-lg mb-6 w-full" style="font-family: 'Poppins', sans-serif;">
    <h1 class="text-2xl font-semibold text-black">Dashboard</h1>
</div>
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

<!-- Container Gabungan: Grafik + Tabel Barang Baru + Tabel Peminjaman Terbaru -->
<div class="chart-container" style="margin: 20px 10px;">
    <h4 class="fw-bold mb-4">Statistik & Data Terbaru</h4>
    <div style="display: flex; gap: 20px;">
        <!-- Diagram Batang -->
        <div style="flex: 2;">
            <canvas id="dashboardChart" height="160"></canvas>
        </div>

        <!-- Tabel Barang Baru dan Peminjaman Terbaru -->
        <div style="flex: 1;">
            <!-- Barang Baru -->
            <div class="mb-4">
                <h4 class="fw-bold mb-2">Barang Baru</h4>
                <table class="table table-bordered table-sm mb-0 custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangBaru as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Peminjaman Terbaru -->
            <div>
                <h5 class="fw-bold mb-2">Peminjaman Terbaru</h5>
                <table class="table table-bordered table-sm mb-0 custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamanTerbaru as $index => $pinjam)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pinjam->nama_peminjam }}</td>
                            <td>
                                <span class="badge 
                            @if($pinjam->status == 'Diterima') bg-success 
                            @elseif($pinjam->status == 'Ditolak') bg-danger 
                            @else bg-secondary 
                            @endif">
                                    {{ $pinjam->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


@endsection

@push('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Barang', 'Kategori', 'Peminjaman', 'Pengembalian', 'User'],
            datasets: [{
                label: 'Jumlah',
                data: [
                    '{{ $jumlahBarang }}',
                    '{{ $jumlahKategori }}',
                    '{{ $jumlahPeminjaman }}',
                    '{{ $jumlahPengembalian }}',
                    '{{ $jumlahUser }}'
                ],
                backgroundColor: [
                    '#6f42c1',
                    '#20c997',
                    '#0dcaf0',
                    '#198754',
                    '#ffc107'
                ],
                borderRadius: 8,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endpush