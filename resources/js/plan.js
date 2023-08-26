var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $location, $http, $timeout) {
  $scope.plan;
  $scope.currentPage = 1;
  $scope.pageSize = 10; // Jumlah item per halaman
  $scope.plan = []; // Data rencana
  $scope.totalItems = 0;
  $scope.totalPages = 0;
  $scope.pages = [];
  $scope.start_date;
  $scope.end_date;

  $scope.isActivePath = function (path) {
    return $location.absUrl() != path;
  };

  function formatDate(date) {
    var year = date.getFullYear();
    var month = String(date.getMonth() + 1).padStart(2, "0");
    var day = String(date.getDate()).padStart(2, "0");
    return year + "-" + month + "-" + day;
  }

  function getData(date1, date2, page) {
    console.log(date1);
    console.log(date2);
    console.log("Page : "+$scope.currentPage);

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
      });
  }

  var today = formatDate(new Date());
  getData(today, today, 1);

  $scope.changePage = function (page) {
    $scope.currentPage = page;
    if($scope.start_date){
      getData($scope.start_date, $scope.start_date, page);
    }
    else {
      getData(today, today, page);
    }
};

  $scope.search = function () {
    $scope.start_date = formatDate(new Date($scope.start_date));
    $scope.end_date = formatDate(new Date($scope.end_date));
    getData($scope.start_date, $scope.end_date, 1);
  };
  
});
