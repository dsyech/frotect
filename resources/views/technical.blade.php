@extends('layout/template')

@section('head')
<title>Technical</title>
@endsection

@section('content')
@include('layout/sidebar')
@verbatim
<div id="main" class="main">
  <div class="pagetitle">
    <h1>Technical</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Frotect</a></li>
        <li class="breadcrumb-item active">Technical</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-header">Upload Datek</div>
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
            <div class="col-3">
              <input class="form-control" type="file" id="formFile" file-model="myFile">
            </div>
            <div class="col-3">
              <button class="btn btn-success" ng-click="uploadFile()">Upload Excel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="alert alert-warning" ng-hide="loading">Loading please wait</div>
    </div>
    <div class="row">
        <div class="card">
          <div class="card-header">Data Teknis</div>
          <div class="card-body table-responsive">
            <table class="table table-striped" style="overflow-x: auto">
              <thead>
                <tr>
                  <th scope="col">Witel</th>
                  <th scope="col">STO</th>
                  <th scope="col">Platform</th>
                  <th scope="col">NE</th>
                  <th scope="col">Shelf</th>
                  <th scope="col">Slot</th>
                  <th scope="col">Port</th>
                  <th scope="col">Type From</th>
                 <th scope="col">NE From</th>
                 <th scope="col">Port From</th>
                 <th scope="col">Type To</th>
                 <th scope="col">NE To</th>
                 <th scope="col">Port To</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="t in technical">
                  <th scope="row">{{t.witel}}</th>
                  <td>{{t.node}}</td>
                  <td>{{t.platform}}</td>
                  <td>{{t.ne}}</td>
                  <td>{{t.shelf}}</td>
                  <td>{{t.slot}}</td>
                  <td>{{t.port}}</td>
                  <td>{{t.type_from}}</td>
                  <td>{{t.ne_from}}</td>
                  <td>{{t.port_from}}</td>
                  <td>{{t.type_to}}</td>
                  <td>{{t.ne_to}}</td>
                  <td>{{t.port_to}}</td>
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
<script src="resources/js/technical.js"></script>
@endsection