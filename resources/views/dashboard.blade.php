@extends('layout/template')

@section('head')
<title>Dashboard</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
      #map {
          height: 600px;
          margin-bottom: 5%
      }
  </style>
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
        <li class="breadcrumb-item active">Dashboard</li>
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
                <h6>{{ persen_patroli | number:2 }}</h6>
                <p class="text-muted small pt-2 ps-1"> {{total_actual_patroli}} Actual /
                  {{total_plan_patroli}} Plan</p>

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
                <h6>{{ persen_wasman| number:2 }}</h6>
                <p class="text-muted small pt-2 ps-1"> {{total_actual_wasman}} Actual /
                  {{total_plan_wasman}} Plan</p>

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
                <h6>0</h6>
                <p class="text-muted small pt-2 ps-1"> 0</p>

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
                <h6>0</h6>
                <p class="text-muted small pt-2 ps-1"> 0</p>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="alert alert-warning" ng-hide="loading">Loading please wait</div>
    </div>
    <div class="row">
      <!-- Left side columns -->
      <div class="col-12 col-lg-9">
        <div class="row">
          <!-- Reports -->
          <div class="col-12 col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Laporan Patroli</h5>
                <div id="patroliChart"></div>
              </div>

            </div>
          </div><!-- End Reports -->
          <div class="col-12 col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Laporan Wasman</h5>
                <div id="wasmanChart"></div>
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
            <h5 class="card-title">Konsistensi Laporan</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Witel</th>
                  <th scope="col">Laporan</th>
                  <th scope="col">Lokasi</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="l in laporan">
                  <th scope="row">{{l.witel}}</th>
                  <td>{{l.laporan | number:2}}</td>
                  <td>{{ lokasi[$index].lokasi | number:2 }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!-- End Recent Activity -->
      </div><!-- End Right side columns -->

    </div>
    <div class="row">
      <div class="col-12 col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Gangguan</h5>
            <div id="map"></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Span Loss High</h5>
            <div class="card-body table-responsive">
              <table class="table table-striped" style="overflow-x: auto">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Witel</th>
                    <th scope="col">STO A</th>
                    <th scope="col">STO B</th>
                    <th scope="col">System</th>
                    <th scope="col">NE</th>
                    <th scope="col">Shelf</th>
                    <th scope="col">Slot</th>
                    <th scope="col">Port</th>
                    <th scope="col">Delta</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="s in slh">
                    <td>{{$index+1}}</td>
                    <td>{{s.witel}}</td>
                    <td>{{s.link_a}}</td>
                    <td>{{s.link_b}}</td>
                    <td>{{s.system}}</td>
                    <td>{{s.ne}}</td>
                    <td>{{s.shelf}}</td>
                    <td>{{s.slot}}</td>
                    <td>{{s.port}}</td>
                    <td><button class="btn btn-danger">{{s.delta}} dB</button>
                     </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div><!-- End #main -->
@endverbatim
@include('layout/footer')
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="resources/js/dashboard.js"></script>
@endsection