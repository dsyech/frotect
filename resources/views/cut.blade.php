@extends('layout/template')

@section('head')
<title>Data Gangguan</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
      #map {
          height: 500px;
          margin-bottom: 5%
      }
  </style>
@endsection

@section('content')
@include('layout/sidebar')
@verbatim
<div id="main" class="main">
  <div class="pagetitle">
    <h1>Data Gangguan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Frotect</a></li>
        <li class="breadcrumb-item active">Data Gangguan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-header">Lokasi Gangguan</div>
        <div class="card-body">
          <div id="map"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="alert alert-warning" ng-hide="loading">Loading please wait</div>
    </div>
    <div class="row">
        <div class="card">
          <div class="card-header">Data Gangguan</div>
          <div class="card-body table-responsive">
            <table class="table table-striped" style="overflow-x: auto">
              <thead>
                <tr>
                  <th scope="col">Witel</th>
                  <th scope="col">Ruas</th>
                  <th scope="col">Laporan</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Nomor HP</th>
                  <th scope="col">Foto</th>
                 <th scope="col">Lokasi</th>
                 <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr  ng-repeat="c in cut">
                  <th scope="row">{{c.witel}}</th>
                  <td>{{c.link}}</td>
                  <td>{{c.report}}</td>
                  <td>{{c.name}}</td>
                  <td>{{c.phone_number}}</td>
                  <td><img src={{c.photo}} alt="" height="100px"></td>
                  <td>
                    <button class="btn btn-small btn-success">
                    <i class="fa-solid fa-location-pin"></i> Lokasi</button>
                  </td>
                <td><button class="btn btn-small btn-danger">
                  <i class="fa-solid fa-trash"></i> Hapus
              </button></td>
                </tr>
              </tbody>
            </table>
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
<script src="resources/js/cut.js"></script>
@endsection