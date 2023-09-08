@extends('layout/template')

@section('head')
<title>Span Loss High</title>
@endsection

@section('content')
@include('layout/sidebar')
@verbatim
<div id="main" class="main">
  <div class="pagetitle">
    <h1>Span Loss High</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Frotect</a></li>
        <li class="breadcrumb-item active">Span Loss High</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-header">Upload Slh</div>
        <div class="card-body">
          <div class="row">
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
          <div class="card-header">Span Loss High</div>
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
<script src="resources/js/slh.js"></script>
@endsection