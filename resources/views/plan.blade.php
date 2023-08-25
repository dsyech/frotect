@extends('layout/template')

@section('head')
<title>Beranda</title>
@endsection

@section('content')
@include('layout/sidebar')
@verbatim
<div id="main" class="main">
  <div class="pagetitle">
    <h1>Patroli & Wasman</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Frotect</a></li>
        <li class="breadcrumb-item active">Patroli & Wasman</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
        <div class="card">
          <div class="card-header">Plan Patroli & Wasman</div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Witel</th>
                  <th scope="col">Nama Teknisi</th>
                  <th scope="col">Nomor HP</th>
                  <th scope="col">Aktifitas</th>
                  <th scope="col">Link A</th>
                  <th scope="col">Link B</th>
                  <th scope="col">Laporan</th>
                  <th scope="col">Foto</th>
                  <th scope="col">Lokasi</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="p in plan">
                  <th scope="row">{{p.witel}}</th>
                  <td>{{p.name}}</td>
                  <td>{{p.phone_number}}</td>
                  <td>{{p.activity}}</td>
                  <td>{{p.link_a}}</td>
                  <td>{{p.link_b}}</td>
                  <td>{{p.report}}</td>
                  <td><img ng-src="{{ 'http://localhost/frotect/' + p.photo }}" alt="" srcset=""></td>
                  <td></td>
                  <td></td>

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
<script src="resources/js/plan.js"></script>
@endsection