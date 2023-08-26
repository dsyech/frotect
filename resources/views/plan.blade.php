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
        <div class="card-header">Upload Plan</div>
        <div class="card-body">
          <div class="row">
            <div class="col-3">
              <select class="form-select" aria-label="Default select example" ng-change="witel()" ng-model="selectedWitel">
                <option value="" selected="">TREG1 - Pilih Witel</option>
                <option value="Aceh">Aceh</option>
                <option value="Medan">Medan</option>
                <option value="Sumut">Sumut</option>
                <option value="Sumbar">Sumbar</option>
                <option value="Ridar">Ridar</option>
                <option value="Rikep">Rikep</option>
                <option value="Jambi">Jambi</option>
                <option value="Bengkulu">Bengkulu</option>
                <option value="Babel">Babel</option>
                <option value="Sumsel">Sumsel</option>
                <option value="Lampung">Lampung</option>
              </select>
            </div>
            <div class="col-6">
              <input class="form-control" type="file" id="formFile">
            </div>
            <div class="col-3">
              <button class="btn btn-success">Upload Excel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                  <td><img ng-src="{{ 'http://10.16.110.100/frotect/' + p.photo }}" alt="" height="100px"></td>
                   <td>
                    <button class="btn btn-small btn-danger" ng-if="p.has_location">
                        <i class="fa-solid fa-location-pin"></i>
                    </button>
                    <button class="btn btn-small" ng-if="!p.has_location" disabled style="background-color: #e9ecef;">
                        <i class="fa-solid fa-location-pin"></i>
                    </button>
                </td>

                </tr>
              </tbody>
            </table>
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                  <li class="page-item" ng-class="{disabled: currentPage === 1}">
                      <a class="page-link" href="#" ng-click="changePage(1)">First</a>
                  </li>
                  <li class="page-item" ng-class="{disabled: currentPage === 1}">
                      <a class="page-link" href="#" ng-click="changePage(currentPage - 1)">Previous ({{currentPage - 1}})</a>
                  </li>
                  <li class="page-item disabled">
                    <a class="page-link" href="#" ng-click="changePage(totalPages)">Page {{currentPage}}</a>
                </li>
                  <li class="page-item" ng-repeat="page in pages track by $index" ng-class="{active: currentPage === page}">
                      <a class="page-link" href="#" ng-click="changePage(page)">{{ page }}</a>
                  </li>
                  <li class="page-item" ng-class="{disabled: currentPage === totalPages}">
                      <a class="page-link" href="#" ng-click="changePage(currentPage + 1)">Next ({{currentPage + 1}})</a>
                  </li>
                  <li class="page-item" ng-class="{disabled: currentPage === totalPages}">
                      <a class="page-link" href="#" ng-click="changePage(totalPages)">Last ({{totalPages}})</a>
                  </li>

              </ul>
          </nav>
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