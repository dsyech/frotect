var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $http) {
  $scope.location = [];
  $scope.start_date = localStorage.getItem("start_date");
  $scope.end_date = localStorage.getItem("end_date");
  $scope.phone_number = localStorage.getItem("phone_number");

  $scope.checkLocation = function () {
    $http
      .get(
        "api/location?start_date=" +
          $scope.start_date +
          "&end_date=" +
          $scope.end_date +
          "&phone_number=" +
          $scope.phone_number
      )
      .then(function (response) {
        $scope.location = response.data;
        console.log(response.data);

        var map = L.map("map");

        // Iterasi melalui data respons dan tambahkan marker untuk setiap pasangan lat dan long
        if($scope.location.length){
            initialLatLng = [$scope.location[0].lat, $scope.location[0].long];
            map.setView(initialLatLng, 10);
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
            var initialLatLng = ["0", "0"];
            map.setView(initialLatLng, 10);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(
              map
            );
        }
      });
  };

  $scope.checkLocation();
});
