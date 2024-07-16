@extends('layouts.dashboard-layout')
    @section('content')
    @section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tambah Aset Hardware</h1>
        </div>
        <!-- End Page Title -->
        
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Hardware</h5>
                            
                            <form action="{{ route('simpan-data-hardware') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label for="nomor_barang" class="col-sm-2 col-form-label">No Inventaris</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nomor_inventaris" name="no_inventaris"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_produk" class="col-sm-2 col-form-label">Tahun</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tahun" name="tahun"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nomor_serial_produk" class="col-sm-2 col-form-label">Jenis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jenis" name="jenis" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Merek</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="merek" name="merek" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Proc</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Proc" name="proc" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">RAM</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="ram"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">HDD</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="hdd"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">IP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="ip"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="user" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Unit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="unit"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Lokasi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="lokasi"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="status" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Windows</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="windows"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Office</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="office"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Garansi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="garansi"/>
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