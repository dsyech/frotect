var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $location, $http) {
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
  $scope.start_date = today;
  $scope.end_date = today;
  $scope.dateUpload = today;
  $scope.selectedWitel = "";

  $scope.uploadFile = function () {
    var file = $scope.myFile;
    console.log("file is ");
    console.dir(file); // Data file berhasil ditampilkan

    var formData = new FormData();
    formData.append("file", file);
    formData.append("witel", $scope.selectedWitel);
    formData.append("date", formatDate($scope.dateUpload));
    

    $http
      .post("api/plan/file", formData, {
        headers: { "Content-Type":undefined },
        transformRequest: angular.identity
      })
      .then(function (response) {
        // Berhasil, lakukan sesuatu
        console.log("Upload berhasil:", response.data);
      })
      .catch(function (error) {
        // Gagal, lakukan sesuatu
        console.error("Upload gagal:", error);
      });
  };

  $scope.isActivePath = function (path) {
    return $location.absUrl() != path;
  };

  function getData(date1, date2, witel, page) {
    $scope.plan = [];
    console.log(date1);
    console.log(date2);
    console.log(witel);
    console.log(page);

    if (witel != "") {
      $http
        .get(
          "api/plan?start_date=" +
            date1 +
            "&end_date=" +
            date2 +
            "&witel=" +
            witel +
            "&page=" +
            page
        )
        .then(function (response) {
          $scope.plan = response.data.data;
          console.log($scope.plan);
          $scope.totalPages = response.data.last_page;
          console.log($scope.totalPages);
        });
    } else {
      $http
        .get(
          "api/plan?start_date=" +
            date1 +
            "&end_date=" +
            date2 +
            "&page=" +
            page
        )
        .then(function (response) {
          $scope.plan = response.data.data;
          console.log($scope.plan);
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
});

app.directive("fileModel", [
  "$parse",
  function ($parse) {
    return {
      restrict: "A",
      link: function (scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind("change", function () {
          scope.$apply(function () {
            modelSetter(scope, element[0].files[0]);
          });
        });
      },
    };
  },
]);

// app.service('fileUpload', ['$http', function ($http) {
//   this.uploadFileToUrl = function(file, uploadUrl) {
//      var fd = new FormData();
//      fd.append('file', file);

//      $http:.post(uploadUrl, fd, {
//         transformRequest: angular.identity,
//         headers: {'Content-Type': undefined}
//      })
//      .success(function() {
//      })
//      .error(function() {
//      });
//   }
// }]);
