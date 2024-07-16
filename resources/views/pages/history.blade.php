@extends('layouts.dashboard-layout')
@section('content')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data History Pekerjaan</h1>
        </div>
        <!-- End Page Title -->

        <!-- main -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data History</h5>
                            <a href="form-inventaris.html" type="button" class="btn btn-rounded btn-danger mb-3">Print</a>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Teknisi</th>
                                        <th>Created</th>
                                        <th>Progress</th>
                                        <th>Finished</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($histories as $index => $history)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $history->name }}</td>
                                            <td>{{ $history->category }}</td>
                                            <td>{{ $history->technician }}</td>
                                            <td>{{ $history->created_at }}</td>
                                            <td>{{ $history->progress_at }}</td>
                                            <td>{{ $history->finished_at }}</td>
                                            <td>{{ $history->duration }} Hour(s)</td>
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
