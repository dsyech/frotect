var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $location, $http, $timeout) {
    function formatDate(date) {
    var year = date.getFullYear();
    var month = String(date.getMonth() + 1).padStart(2, "0");
    var day = String(date.getDate()).padStart(2, "0");
    return year + "-" + month + "-" + day;
  }
  
  $scope.plan;
  $scope.currentPage = 1;
  $scope.pageSize = 10; // Jumlah item per halaman
  $scope.plan = []; // Data rencana
  $scope.totalItems = 0;
  $scope.totalPages = 0;
  $scope.pages = [];
  var today = formatDate(new Date());
  $scope.start_date=today;
  $scope.end_date=today;
  $scope.selectedWitel="";

  $scope.isActivePath = function (path) {
    return $location.absUrl() != path;
  };



  function getData(date1, date2, witel, page) {
    $scope.plan=[];
    console.log(date1);
    console.log(date2);
    console.log(witel);
    console.log(page);

    if(witel!=""){
      $http
      .get(
        "api/plan?start_date=" +
          date1 +
          "&end_date=" +
          date2+"&witel="+witel+"&page="+page
      )
      .then(function (response) {
        $scope.plan = response.data.data;
        console.log($scope.plan);
        $scope.totalPages = response.data.last_page;
        console.log( $scope.totalPages);
      });
    }
    else {
      $http
      .get(
        "api/plan?start_date=" +
          date1 +
          "&end_date=" +
          date2+"&page="+page
      )
      .then(function (response) {
        $scope.plan = response.data.data;
        console.log($scope.plan);
        $scope.totalPages = response.data.last_page;
        console.log( $scope.totalPages);
      });
    }

  }


  getData(today, today, $scope.selectedWitel, 1);

  $scope.changePage = function (page) {
    $scope.currentPage = page;
    if($scope.start_date){
      getData($scope.start_date, $scope.start_date, $scope.selectedWitel, page);
    }
    else {
      getData(today, today, $scope.selectedWitel, page);
    }
};

  $scope.search = function () {
    $scope.start_date = formatDate(new Date($scope.start_date));
    $scope.end_date = formatDate(new Date($scope.end_date));
    getData($scope.start_date, $scope.end_date, $scope.selectedWitel, 1);
  };

  $scope.witel = function() {
    // Di sini Anda bisa mengakses nilai terpilih dengan $scope.selectedWitel
    console.log('Witel terpilih:', $scope.selectedWitel);
    getData( $scope.start_date,  $scope.end_date, $scope.selectedWitel, 1);
    // Lakukan tindakan atau perubahan sesuai dengan nilai terpilih
};
  
});
