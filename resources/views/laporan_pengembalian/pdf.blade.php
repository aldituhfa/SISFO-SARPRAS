<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            font-size: 12px;
            border: 1px solid #000;
            padding: 6px;
        }
    </style>
</head>
<body>
    <h3>Laporan Pengembalian</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Kondisi Barang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $i => $data)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $data->nama_peminjam }}</td>
                <td>{{ $data->nama_barang }}</td>
                <td>{{ $data->jumlah }}</td>
                <td>{{ $data->tanggal_pinjam }}</td>
                <td>{{ $data->tanggal_kembali }}</td>
                <td>{{ $data->kondisi_barang }}</td>
                <td>{{ $data->aksi ?? 'Pending' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
