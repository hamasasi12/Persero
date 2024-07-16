@extends('layouts.dashboard-layout')
@section('content')
@section('main')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Input Permintaan Perbaikan</h1>
        </div>
        <!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Permintaan Perbaikan</h5>

                            <form action="{{ route('Perbaikan.store') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label for="nomor_barang" class="col-sm-2 col-form-label">No Permintaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nomor_permintaan" name="no_permintaan" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="deskripsi_produk" class="col-sm-2 col-form-label">Deskripsi Permintaan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="deskripsi_permintaan" name="deskripsi_permintaan" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nomor_serial_produk" class="col-sm-2 col-form-label">Departemen</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="departemen" name="departemen" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Pic Permintaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pic_permintaan" name="pic_permintaan" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggal_masuk_produk" class="col-sm-2 col-form-label">Tanggal
                                        Permintaan</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal_permintaan" name="tanggal_permintaan" />
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-md-end mt-3">
                                    <button type="submit" class="btn"
                                        style="background-color: #525ceb; color: white">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection