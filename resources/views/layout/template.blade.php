<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="resources/assets/img/favicon.png" rel="icon">
  <link href="resources/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="resources/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="resources/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="resources/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="resources/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="resources/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="resources/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="resources/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="resources/assets/css/style.css" rel="stylesheet">
    @yield('head')
</head>

<body ng-app="myApp" ng-controller="myCtrl">
    @yield('content')
</body>
 <!-- Vendor JS Files -->
 <script src="resources/assets/vendor/apexcharts/apexcharts.min.js"></script>
 <script src="resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="resources/assets/vendor/chart.js/chart.umd.js"></script>
 <script src="resources/assets/vendor/echarts/echarts.min.js"></script>
 <script src="resources/assets/vendor/quill/quill.min.js"></script>
 <script src="resources/assets/vendor/simple-datatables/simple-datatables.js"></script>
 <script src="resources/assets/vendor/tinymce/tinymce.min.js"></script>
 <script src="resources/assets/vendor/php-email-form/validate.js"></script>

 <!-- Template Main JS File -->
 <script src="resources/assets/js/main.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
@yield('js')

</html>