<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Aset Hardware</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px; /* Adjust font size to fit content */
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
    <h3>Data Aset Hardware</h3>
    <p>Dicetak pada: {{ now()->translatedFormat('l, d F Y H:i:s') }}</p>
    <table>
        <thead>
            <tr>
                <th>No Aset</th>
                <th>No Inventaris</th>
                <th>Description</th>
                <th>IP</th>
                <th>User</th>
                <th>Unit</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Windows</th>
                <th>Office</th>
                <th>Garansi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->no_inventaris }}</td>
                    <td>
                        Tahun: {{ $item->tahun }},
                        Jenis: {{ $item->jenis }},
                        Merek: {{ $item->merek }},
                        Proc: {{ $item->proc }},
                        RAM: {{ $item->ram }},
                        HDD: {{ $item->hdd }}
                    </td>
                    <td>{{ $item->ip }}</td>
                    <td>{{ $item->user }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->windows }}</td>
                    <td>{{ $item->office }}</td>
                    <td>{{ $item->garansi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
