@extends('layouts.dashboard-layout')

@section('title','General Dashboard')

@section('main')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <!-- Daftar Request Masuk -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Daftar Request Masuk</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-inbox"></i>
              </div>
              <div class="ps-3">
                <h6 id="permintaan-masuk-count">0</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Daftar Request Masuk -->

      <!-- Daftar Request Sedang Dikerjakan -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Daftar Request Sedang Dikerjakan</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-hourglass-split"></i>
              </div>
              <div class="ps-3">
                <h6 id="sedang-dikerjakan-count">0</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Daftar Request Sedang Dikerjakan -->

      <!-- Daftar Request Selesai Dikerjakan -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Daftar Request Selesai Dikerjakan</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-check-circle"></i>
              </div>
              <div class="ps-3">
                <h6 id="selesai-dikerjakan-count">0</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Daftar Request Selesai Dikerjakan -->
    </div>
  </section>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
  function fetchData() {
    fetch('/dashboard/data')
      .then(response => response.json())
      .then(data => {
        document.getElementById('permintaan-masuk-count').textContent = data.permintaanMasuk;
        document.getElementById('sedang-dikerjakan-count').textContent = data.sedangDikerjakan;
        document.getElementById('selesai-dikerjakan-count').textContent = data.selesaiDikerjakan;
      })
      .catch(error => console.error('Error fetching data:', error));
  }

  // Fetch data immediately, then every 30 seconds
  fetchData();
  setInterval(fetchData, 30000);
});
</script>

@endsection

