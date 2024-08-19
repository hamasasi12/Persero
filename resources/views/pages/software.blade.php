@extends('layouts.dashboard-layout')

@section('content')

@section('main')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Aset Software</h1>
    </div>
    <!-- End Page Title -->

    @if ($message = Session::get('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil',
                    text: '{{ Session::get('message') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Aset Software</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <a href="{{ route('software.print') }}" class="btn btn-rounded btn-danger">Print to PDF</a>
                                <a href="{{ route('export.software') }}" class="btn btn-primary">Export to Excel</a>
                            </div>
                            <a href="{{ route('TambahDataSoftware.create') }}" type="button" class="btn btn-rounded btn-success">
                                <i class="bi bi-plus-square" style="margin-right: 5px"></i>Tambah Data
                            </a>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable table-striped">
                            <thead>
                                <tr>
                                    <th>No Aset</th>
                                    <th>No Inventaris</th>
                                    <th>Tahun</th>
                                    <th>Jenis Aplikasi</th>
                                    <th>Nama Aplikasi</th>
                                    <th>Pengguna</th>
                                    <th>Divisi/Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($software as $index => $item )
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->no_inventaris }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->jenis_aplikasi }}</td>
                                    <td>{{ $item->nama_aplikasi }}</td>
                                    <td>{{ $item->pengguna }}</td>
                                    <td>{{ $item->divisi }}</td>
                                    <td>
                                        <a href="{{ route('edit-data-software', $item->id) }}"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('delete-data-software', $item->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash3-fill" style="color: red"></i></a>
                                    </td>
                                </tr>        
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="header-container">
            <p>Hamas Akif Sanie</p>
        </div>
    </header>


    <main class="main-container">
        <p></p>
    </main>


    <footer>
        <div class="footer-container">

        </div>
    </footer>
</body>
</html>