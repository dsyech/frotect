var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $location, $http) {
  function formatDate(date) {
    var year = date.getFullYear();
    var month = String(date.getMonth() + 1).padStart(2, "0");
    var day = String(date.getDate()).padStart(2, "0");
    return year + "-" + month + "-" + day;
  }

  $scope.loading=false;
  $scope.cut = [];
  $scope.location = [];
  $scope.currentPage = 1;
  $scope.pageSize = 10; // Jumlah item per halaman
  $scope.totalItems = 0;
  $scope.totalPages = 0;
  $scope.pages = [];
  var today = formatDate(new Date());
  $scope.start_date = today;
  $scope.end_date = today;
  $scope.dateUpload = today;
  $scope.selectedWitel = "";

  $scope.checkLocation = function () {
    $http
      .get(
        "api/cut?start_date=" +
          $scope.start_date +
          "&end_date=" +
          $scope.end_date
      )
      .then(function (response) {
        $scope.location = response.data.data;
        console.log(response.data);

        var map = L.map("map");

        // Iterasi melalui data respons dan tambahkan marker untuk setiap pasangan lat dan long
        if($scope.location.length){
            initialLatLng = [$scope.location[0].lat, $scope.location[0].long];
            map.setView(initialLatLng, 5.5);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(
              map
            );
            for (var i = 0; i < $scope.location.length; i++) {
                console.log(i);
                var lat = parseFloat($scope.location[i].lat);
                var long = parseFloat($scope.location[i].long);
                L.marker([lat, long], { draggable: false }).addTo(map);
              }
        }
        else {
            var initialLatLng = [-0.6, 102];
            map.setView(initialLatLng, 5.5);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(
              map
            );
        }
      });
  };

  $scope.checkLocation();


  $scope.isActivePath = function (path) {
    return $location.absUrl() != path;
  };

  function getData(date1, date2, witel, page) {
    $scope.loading=false;
    console.log(date1);
    console.log(date2);
    console.log(witel);
    console.log(page);

    if (witel != "") {
      $http
        .get(
          "api/cut?start_date=" +
            date1 +
            "&end_date=" +
            date2 +
            "&witel=" +
            witel +
            "&page=" +
            page
        )
        .then(function (response) {
          $scope.loading=true;
          $scope.cut = response.data.data;
          console.log($scope.cut);
          $scope.totalPages = response.data.last_page;
          console.log($scope.totalPages);
        });
    } else {
      $http
        .get(
          "api/cut?start_date=" +
            date1 +
            "&end_date=" +
            date2 +
            "&page=" +
            page
        )
        .then(function (response) {
          $scope.loading=true;
          $scope.cut = response.data.data;
          console.log($scope.cut);
          $scope.totalPages = response.data.last_page;
          console.log($scope.totalPages);
        });
    }
  }

  getData(today, today, $scope.selectedWitel, 1);

  $scope.changePage = function (page) {
    $scope.currentPage = page;
    if ($scope.start_date) {
      getData($scope.start_date, $scope.start_date, $scope.selectedWitel, page);
    } else {
      getData(today, today, $scope.selectedWitel, page);
    }
  };

  $scope.search = function () {
    $scope.start_date = formatDate(new Date($scope.start_date));
    $scope.end_date = formatDate(new Date($scope.end_date));
    getData($scope.start_date, $scope.end_date, $scope.selectedWitel, 1);
  };

  $scope.witel = function () {
    // Di sini Anda bisa mengakses nilai terpilih dengan $scope.selectedWitel
    console.log("Witel terpilih:", $scope.selectedWitel);
    getData($scope.start_date, $scope.end_date, $scope.selectedWitel, 1);
    // Lakukan tindakan atau perubahan sesuai dengan nilai terpilih
  };

  $scope.location = function(phone_number){
    console.log(phone_number);
    localStorage.setItem("phone_number", phone_number);
    localStorage.setItem("start_date", $scope.start_date);
    localStorage.setItem("end_date", $scope.end_date);
    window.location.href = '/frotect/location';
  }
});