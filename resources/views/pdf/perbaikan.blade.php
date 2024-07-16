<!-- resources/views/pdf/perbaikan.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Permintaan Perbaikan</title>
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
    <h3>Data Permintaan Perbaikan</h3>
    <p>Dicetak pada: {{ now()->translatedFormat('l, d F Y H:i:s') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Permintaan</th>
                <th>Deskripsi Permintaan</th>
                <th>Departemen</th>
                <th>Pic Permintaan</th>
                <th>Tanggal Permintaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->no_permintaan }}</td>
                    <td>{{ $item->deskripsi_permintaan }}</td>
                    <td>{{ $item->departemen }}</td>
                    <td>{{ $item->pic_permintaan }}</td>
                    <td>{{ $item->tanggal_permintaan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
