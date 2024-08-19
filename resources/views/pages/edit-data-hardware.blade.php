@extends('layouts.dashboard-layout')
    @section('content')
    @section('main')
        
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Aset Hardware</h1>
        </div>
        <!-- End Page Title -->
        
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Hardware</h5>
                            
                            <form action="{{ url('update-data-hardware', $hardware->id) }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label for="nomor_barang" class="col-sm-2 col-form-label">No Inventaris</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="no_inventaris" name="no_inventaris" value="{{ $hardware->no_inventaris }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nama_produk" class="col-sm-2 col-form-label">Tahun</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tahun" name="tahun" value="{{ $hardware->tahun }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nomor_serial_produk" class="col-sm-2 col-form-label">Jenis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jenis" name="jenis" value="{{ $hardware->jenis }}"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Merek</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="merek" name="merek" value="{{ $hardware->merek }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Proc</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Proc" name="proc" value="{{ $hardware->proc }}"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">RAM</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ram" name="ram" value="{{ $hardware->ram }}"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">HDD</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="hdd" name="hdd" value="{{ $hardware->hdd }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">IP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ip" name="ip" value="{{ $hardware->ip }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user" name="user" value="{{ $hardware->user }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Unit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="unit" name="unit" value="{{ $hardware->unit }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Lokasi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $hardware->lokasi }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status" name="status" value="{{ $hardware->status }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Windows</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="windows" name="windows" value="{{ $hardware->windows }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Office</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="office" name="office" value="{{ $hardware->office }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_produk" class="col-sm-2 col-form-label">Garansi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="garansi" name="garansi" value="{{ $hardware->garansi }}" />
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