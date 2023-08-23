var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $location) {
  $scope.isActivePath = function (path) {
    return $location.path() === path;
  };

  function formatDate(date) {
    var year = date.getFullYear();
    var month = String(date.getMonth() + 1).padStart(2, "0");
    var day = String(date.getDate()).padStart(2, "0");
    return year + "-" + month + "-" + day;
  }

  function getData(date1, date2) {
    console.log(date1);
    console.log(date2);
    //count patroli
    //count wasman
    //count ggn
    //count slh
    //chart patroli
    //chart wasman
    //konsistensi patroli dan wasman
  }

  var today = formatDate(new Date());
  getData(today, today);

  $scope.search = function () {
    var start_date = formatDate(new Date($scope.start_date));
    var end_date = formatDate(new Date($scope.end_date));
    getData(start_date, end_date);
  };
});
