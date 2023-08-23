@extends('layout/template')

@section('head')
<title>Kodeskrip - Jasa Pembuatan Aplikasi Website</title>
@endsection

@section('content')
@verbatim
<div ng-app="myApp" ng-controller="myCtrl">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container container-fluid">
            <a href="" class="navbar-brand">
                <!-- <img src="https://www.hercodigital.id/wp-content/uploads/2021/06/hercodigital.png" alt="" width="186px"> -->
                <p style="font-size: 20pt"><b><span style="color: #1922bd">Kode</span><span>skrip;</span></b></p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active me-5" aria-current="page" href="#">Beranda</a>
                    <a class="nav-link me-5" href="#">Layanan</a>
                    <a class="nav-link me-5" href="#">Solusi Digital</a>
                    <a class="nav-link me-5" href="#">Portofolio</a>
                    <a href="#" class="btn btn-primary me-5 " style="background-color: #1922bd"><i
                            class="fa fa-phone"></i>
                        Hubungi Kami</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
    <!-- Hero -->
    <div style="background-color: #edf9ff">
        <div class="container">
            <div class="row pt-5 pb-5">
                <div class="col-12 col-lg-5 d-flex flex-column justify-content-center">
                    <h1>Jasa Pembuatan <span class="text-danger">Aplikasi</span> & <span
                            class="text-danger">Website</span>
                    </h1>
                    <br>
                    <p>Miliki Aplikasi & Website dengan performance terbaik, dengan tingkat keamanan tinggi dan tampilan
                        UI/UX yang
                        menarik.</p>
                    <div class="d-flex flex-row">
                        <div class="me-2 pb-5"> <button class="btn btn-md btn-primary"
                                style="background-color: #1922bd"><i class="fa fa-play"></i> Tentang Kami</button></div>
                        <div> <button class="btn btn-md btn-warning"><i class="fa fa-edit"></i> Portofolio</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-center ms-auto d-none d-lg-block">
                    <img src="https://www.hercodigital.id/wp-content/uploads/2021/07/banner-home-page-1.png" alt=""
                        srcset="" width="80%">
                </div>
            </div>

        </div>
    </div>
    <!-- Hero -->
    <!-- Services -->
    <div class="container text-center mt-5">
        <p class="badge p-2" style="background-color: #1922bd">Layanan kami</p>
        <h2>Kami melayani pembuatan aplikasi dan website.</h2>
        <p>Pembuatan aplikasi dan website dengan database terintegrasi</p>
        <div class="row">
            <div class="col-6 col-lg-3 mb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <img src="resources/img/api.png" alt="" srcset="" width="30%" class="mb-2">
                        <p class="mb-0">Aplikasi Web</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <img src="resources/img/mobile.png" alt="" srcset="" width="30%" class="mb-2">
                        <p class="mb-0">Aplikasi Mobile</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <img src="resources/img/landing-page.png" alt="" srcset="" width="30%" class="mb-2">
                        <p class="mb-0">Website</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <img src="resources/img/shop.png" alt="" srcset="" width="30%" class="mb-2">
                        <p class="mb-0">E-Commerce</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services -->
    <!-- Solution -->
    <div class="container mt-5">
        <div class="text-center">
            <p class="badge p-2" style="background-color: #1922bd">Solusi Digital</p>
        </div>

        <h2 class="text-center">Solusi yang ditawarkan Kodeskrip untuk Bisnis Anda</h2>
        <p class="text-center">Kami sudah membuat aplikasi yang dapat langsung diimplementasikan di Bisnis Anda.</p>
        <div class="row">
            <div class="col-12 col-lg-6 mb-2">
                <div class="card">
                    <div class="card-header bg-dark text-light">Booking Antrian</div>
                    <div class="card-body">
                        <button class="btn btn-sm btn-primary">Order</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-2">
                <div class="card">
                    <div class="card-header bg-dark text-light">eMenu</div>
                    <div class="card-body">Tes</div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-2">
                <div class="card">
                    <div class="card-header bg-dark text-light">Undangan Online</div>
                    <div class="card-body">Tes</div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-2">
                <div class="card">
                    <div class="card-header bg-dark text-light">Absensi</div>
                    <div class="card-body">Tes</div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Solution -->
    <!-- Order -->
    <div class="bg-warning p-3 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9 d-flex align-items-center">
                    <p class="m-0">Ingin segera membuat Aplikasi atau Website untuk Bisnis Anda?</p>
                </div>
                <div class="col-12 col-lg-3 d-flex align-items-center">
                    <button class="btn btn-md btn-primary" style="background-color: #1922bd">Order Sekarang</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Order -->
    <!-- Footer -->
    <div class="text-white" style="background-color: #1922bd">
        <div class="container p-5">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h5><b>Kodeskrip</b></h5>
                    <p>Solusi digital bisnis Anda.</p><br>
                    <p>Jl. HM Yamin No. 2, Kota Medan, <br>Provinsi Sumatera Utara</p>
                </div>
                <div class="col-12 col-lg-6">
                    <p><i class="fa fa-instagram"></i> Instagram</p>
                    <p><i class="fa fa-youtube"></i> Youtube</p>
                    <p><i class="fa fa-whatsapp"></i> Whatsapp</p>
                    <p><i class="fa fa-telegram"></i> Telegram</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
</div>

@endverbatim
@endsection
@section('js')
<script src="resources/js/home.js"></script>
@endsection