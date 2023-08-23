@extends('layout/template')

@section('head')
<title>Beranda</title>
@endsection

@section('content')
@include('layout/sidebar')
@verbatim
<div id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Frotect</a></li>
        <li class="breadcrumb-item active">Beranda</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="col-12 col-lg-3">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Patroli</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-cone-striped"></i>
              </div>
              <div class="ps-3">
                <h6>96.5%</h6>
                <p class="text-muted small pt-2 ps-1"> 100 Actual / 145 Plan</p>

              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="col-12 col-lg-3">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Wasman</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-cone-striped"></i>
              </div>
              <div class="ps-3">
                <h6>96.5%</h6>
                <p class="text-muted small pt-2 ps-1"> 100 Actual / 145 Plan</p>

              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="col-12 col-lg-3">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Gangguan</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-cone-striped"></i>
              </div>
              <div class="ps-3">
                <h6>96.5%</h6>
                <p class="text-muted small pt-2 ps-1"> 100 Actual / 145 Plan</p>

              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="col-12 col-lg-3">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">SLH</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-cone-striped"></i>
              </div>
              <div class="ps-3">
                <h6>96.5%</h6>
                <p class="text-muted small pt-2 ps-1"> 100 Actual / 145 Plan</p>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row">

      <!-- Left side columns -->
      <div class="col-12 col-lg-9">
        <div class="row">
          <!-- Reports -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Laporan Patroli & Wasman</h5>
                <!-- Kode Chart -->
              </div>

            </div>
          </div><!-- End Reports -->
        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-12 col-lg-3">

        <!-- Recent Activity -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Konsistensi Patroli & Wasman</h5>
          </div>
        </div><!-- End Recent Activity -->
      </div><!-- End Right side columns -->

    </div>
  </section>
</div><!-- End #main -->
@endverbatim
@include('layout/footer')
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
<script src="resources/js/home.js"></script>
@endsection