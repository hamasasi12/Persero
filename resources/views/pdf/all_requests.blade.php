<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Permintaan Masuk/Request User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .pagetitle h1 {
            font-size: 24px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="pagetitle">
        <h1 style="color: rgb(10, 95, 232)">Persero Batam</h1>
        <h3>Request User</h3>
    </div>
    <p>Dicetak pada: {{ now()->translatedFormat('l, d F Y H:i:s') }}</p>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>No Pengaduan</th>
                <th>Deskripsi</th>
                <th>Teknisi</th>
                <th>User</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $index => $request)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    {{ $request->created_at_formatted }}<br/>
                    {{-- <span style="color: red;">Belum Ditangani <br>Selama: {{ $request->created_at ? $request->created_at->diffForHumans() : 'Unknown' }}</span> --}}
                    <p><strong>Created:</strong> {{ $request->created_at }}</p>
                </td>
                <td>
                    <p><strong>DESKRIPSI : </strong><br>{{ $request->deskripsi_req }}</p>
                    <p><strong>ALASAN : </strong><br>{{ $request->alasan_req }}</p>
                    <p><strong>KATEGORI : </strong><br>{{ $request->kategori_req }}</p>
                    
                </td>
                <td>
                    @if ($request->technician)
                        {{ $request->technician->name }}
                    @else
                        Belum Ditugaskan
                    @endif
                </td>
                <td>
                    <p><strong>NAMA : <br>{{ $request->nama }}</strong></p>
                    <p><span><strong>NUP : </strong></span><br>{{ $request->nup }}</p>
                    <p><strong>NO-HP : </strong><br>{{ $request->no_hp }}</p>
                    <p><strong>DIVISI : </strong><br>{{ $request->divisi }}</p>
                </td>
                <td>
                    @if ($request->upload_gambar)
                        <img src="{{ public_path($request->upload_gambar) }}" alt="Uploaded Image" width="100">
                    @else
                        No image available
                    @endif
                    @if ($request->upload_file)
                        <div>
                            <label>Dokumen PDF:</label>
                            <a href="{{ public_path($request->upload_file) }}" target="_blank">PDF </a>
                        </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
