<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #000;
            text-align: left;
        }

        th {
            background: #ddd;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_peminjam }}</td>
                <td>{{ $item->barang }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
