<!-- resources/views/pdf/software.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Aset Software</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        th, td {
            padding: 5px 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="color: rgb(10, 95, 232)">Persero Batam</h1>
    <h3>Data Aset Software</h3>
    <p>Dicetak pada: {{ now()->translatedFormat('l, d F Y H:i:s') }}</p>
    <table>
        <thead>
            <tr>
                <th>No Aset</th>
                <th>No Inventaris</th>
                <th>Tahun</th>
                <th>Jenis Aplikasi</th>
                <th>Nama Aplikasi</th>
                <th>Pengguna</th>
                <th>Divisi/Unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->no_inventaris }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->jenis_aplikasi }}</td>
                    <td>{{ $item->nama_aplikasi }}</td>
                    <td>{{ $item->pengguna }}</td>
                    <td>{{ $item->divisi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
