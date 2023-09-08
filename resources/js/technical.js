var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $location, $http) {
  $scope.technical = [];
  $scope.loading = false;

  $scope.uploadFile = function () {
    $scope.loading = false;
    var file = $scope.myFile;
    console.log("file is ");
    console.dir(file); // Data file berhasil ditampilkan

    var formData = new FormData();
    formData.append("file", file);
    formData.append("witel", $scope.selectedWitel);

    $http
      .post("api/technical/file", formData, {
        headers: { "Content-Type": undefined },
        transformRequest: angular.identity,
      })
      .then(function (response) {
        $scope.loading = true;
        console.log("Upload berhasil:", response.data);
        $scope.getTechnical();
      })
      .catch(function (error) {
        // Gagal, lakukan sesuatu
        console.error("Upload gagal:", error);
        $scope.getTechnical();
      });
  };

  $scope.isActivePath = function (path) {
    return $location.absUrl() != path;
  };

  $scope.getTechnical = function () {
    $http.get("api/technical").then(function (response) {
      $scope.loading = true;
      $scope.technical = response.data.data;
      console.log($scope.technical);
    });
  };
  $scope.getTechnical();
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
