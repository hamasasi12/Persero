@extends('layouts.dashboard-layout')

@section('content')
@section('main')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Permintaan Masuk</h1>
    </div>
    <!-- End Page Title -->
    @if ($message = Session::get('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
    <!-- main -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Request User</h5>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <a href="{{ route('request-user.print') }}" class="btn btn-rounded btn-danger">Print to PDF</a>
                            <a href="{{ route('export.requests') }}" class="btn btn-primary">Export to Excel</a>
                        </div>
                        <!-- Table with stripped rows -->
                        <div class="table-responsive-lg">
                            <table class="table datatable table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No Pengaduan</th>
                                        <th>Deskripsi</th>
                                        <th>Teknisi</th>
                                        <th>User</th>
                                        <th>File</th>
                                        {{-- <th>Ke Divisi</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($requests as $index => $item)              
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{ $item->created_at_formatted }}<br/><a href="#" type="button" class="btn btn-rounded btn-danger mb-2">Belum Ditangani <br>Selama :{{ $item->created_at ? $item->created_at->diffForHumans() : 'Unknown' }}</a>
                                        <p> <strong>Created : </strong>{{ $item->created_at }}</p>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-rounded btn-primary mb-3" data-toggle="modal" data-target="#detailModal{{ $item->id }}">Detail</button>
                                    </td>
                                    <td>
                                        @if ($item->technician)
                                            {{ $item->technician->name }}
                                        @else
                                            <form action="{{ route('assign.technician', $item->id) }}" method="post">
                                                @csrf
                                                <select name="teknisi" class="form-control">
                                                    <option value="" disabled selected>--Pilih Teknisi--</option>
                                                    @foreach ($technicians as $technician)
                                                        <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-rounded btn-success mt-2">Assign</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="line-height: 0.5">
                                            <p class="font-weight-bold"><i class="bi bi-person-fill"></i> {{ $item->nama }}</p>
                                            {{-- <p style="color: blue">{{ $item->nup }}</p> --}}
                                            <p style="color:rgb(0, 135, 225)"><i class="bi bi-file-earmark-person-fill"></i> {{ $item->nup }}</p>
                                            <p style="color: rgb(255, 81, 0)"><i class="bi bi-telephone-fill"></i> {{ $item->no_hp }}</p>
                                            <p>{{ $item->divisi }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#imageModal{{ $item->id }}">
                                            <i class="bi bi-image-fill"></i>
                                        </button>
                                    </td>
                                    {{-- <td><a href="form-inventaris.html" type="button" class="btn btn-rounded btn-primary mb-3">Pemasaran</a></td> --}}
                                    <td>
                                        <form action="{{ route('requests.dikerjakan', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success mb-3">
                                                <i class="bi bi-arrow-right" style="margin-right: 5px"></i>Kerjakan!
                                            </button>
                                        </form>
                                    </td>
                                    
                                </tr>

                                <!-- Detail Modal -->
                                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Permintaan Masuk</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><span class="font-weight-bold text-primary">NUP</span>              : {{ $item->nup }}</p>
                                                <p><span class="font-weight-bold">Nama</span>: {{ $item->nama }}</p>
                                                <p><span class="font-weight-bold">Divisi</span>           : {{ $item->divisi }}</p>
                                                <p><span class="font-weight-bold">No HP</span>            : {{ $item->no_hp }}</p>
                                                <p><span class="font-weight-bold">Kategori Request</span> : {{ $item->kategori_req }}</p>
                                                <p><span class="font-weight-bold">Deskripsi</span>        : {{ $item->deskripsi_req }}</p>
                                                <p><span class="font-weight-bold">Alasan</span>           : {{ $item->alasan_req }}</p>
                                                <!-- Tambahkan detail lain sesuai kebutuhan -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Detail Modal -->

                                <!-- Image Modal -->
                                <div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel{{ $item->id }}">Image</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                @if ($item->upload_gambar)
                                                    <img src="{{ asset($item->upload_gambar) }}" alt="Uploaded Image" class="img-fluid">
                                                @else
                                                    <p>No image available</p>
                                                @endif

                                                @if ($item->upload_file)
                                                <div>
                                                    <label>Dokumen PDF:</label>
                                                    <a href="{{ asset($item->upload_file) }}" target="_blank">Lihat Dokumen PDF</a>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Image Modal -->

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->
                        {{-- <div class="d-flex justify-content-center">
                            {{ $request->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        // DataTable initialization
        var dataTable = $('#dataTable').DataTable();

        // Search functionality
        $('#searchInput').on('keyup', function() {
            dataTable.search($(this).val()).draw();
        });
    });
</script>

