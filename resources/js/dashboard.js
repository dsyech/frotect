var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $location, $http) {
  $scope.loading = false;
  $scope.laporan = [];
  $scope.lokasi = [];
  $scope.location = [];
  $scope.slh = [];
  $scope.total_plan_patroli = 0;
  $scope.total_plan_wasman = 0;
  $scope.total_actual_patroli = 0;
  $scope.total_actual_wasman = 0;
  $scope.persen_patroli = 0;
  $scope.persen_wasman = 0;


  $scope.isActivePath = function (path) {
    return $location.absUrl() != path;
  };

  function formatDate(date) {
    var year = date.getFullYear();
    var month = String(date.getMonth() + 1).padStart(2, "0");
    var day = String(date.getDate()).padStart(2, "0");
    return year + "-" + month + "-" + day;
  }

  var today = formatDate(new Date());
  $scope.start_date = today;
  $scope.end_date = today;

  function getData(date1, date2) {
    $scope.loading = false;
    console.log(date1);
    console.log(date2);
    $scope.laporan = [];
    $scope.lokasi = [];
    $scope.total_plan_patroli = 0;
    $scope.total_plan_wasman = 0;
    $scope.total_actual_patroli = 0;
    $scope.total_actual_wasman = 0;
    $scope.persen_patroli = 0;
    $scope.persen_wasman = 0;

    $http
      .get("api/report?data=all&start_date=" + date1 + "&end_date=" + date2)
      .then(function (response) {
        console.log(response.data);
        $scope.total_plan_patroli = response.data.total_plan_patroli;
        $scope.total_plan_wasman = response.data.total_plan_wasman;
        $scope.total_actual_patroli = response.data.total_actual_patroli;
        $scope.total_actual_wasman = response.data.total_actual_wasman;
        $scope.persen_patroli =
          ($scope.total_actual_patroli * 100) / $scope.total_plan_patroli;
        $scope.persen_wasman =
          ($scope.total_actual_wasman * 100) / $scope.total_plan_wasman;

        if ($scope.persen_patroli > 0) {
          $scope.persen_patroli = $scope.persen_patroli;
        } else {
          $scope.persen_patroli = 0;
        }

        if ($scope.persen_wasman > 0) {
          $scope.persen_wasman = $scope.persen_wasman;
        } else {
          $scope.persen_wasman = 0;
        }
      });
    $http
      .get("api/report?data=patroli&start_date=" + date1 + "&end_date=" + date2)
      .then(function (response) {
        $scope.super = response.data;
        console.log($scope.super);
        var options = {
          series: [],
          chart: {
            height: 490,
            type: "bar",
            events: {
              dataPointSelection: function (event, chartContext, config) {
                // window.location.href = "/frotect-website/plan";
              },
            },
          },
          plotOptions: {
            bar: {
              columnWidth: "60%",
            },
          },
          colors: ["#03C3EC"],
          dataLabels: {
            enabled: false,
          },
          legend: {
            show: true,
            showForSingleSeries: true,
            customLegendItems: ["Actual", "Plan"],
            markers: {
              fillColors: ["#03C3EC", "#696CFF"],
            },
          },
        };

        var data = [];
        for (var i = 0; i < $scope.super.length; i++) {
          var provinceData = {
            x: $scope.super[i].witel+"("+$scope.super[i].plan_patroli+")",
            y: $scope.super[i].actual_patroli,
            goals: [
              {
                name: "Plan",
                value: parseFloat($scope.super[i].plan_patroli),
                strokeHeight: 5,
                strokeColor: "#696CFF",
              },
            ],
          };
          data.push(provinceData);
        }

        options.series.push({
          name: "Actual",
          data: data,
        });

        document.querySelector("#patroliChart").innerHTML = ""; // Menghapus elemen HTML chart

        var chart = new ApexCharts(
          document.querySelector("#patroliChart"),
          options
        );
        chart.render();
      });
      $http
      .get("api/report?data=wasman&start_date=" + date1 + "&end_date=" + date2)
      .then(function (response) {
        $scope.super = response.data;
        console.log($scope.super);
        var options = {
          series: [],
          chart: {
            height: 490,
            type: "bar",
            events: {
              dataPointSelection: function (event, chartContext, config) {
                // window.location.href = "/frotect-website/plan";
              },
            },
          },
          plotOptions: {
            bar: {
              columnWidth: "60%",
            },
          },
          colors: ["#03C3EC"],
          dataLabels: {
            enabled: false,
          },
          legend: {
            show: true,
            showForSingleSeries: true,
            customLegendItems: ["Actual", "Plan"],
            markers: {
              fillColors: ["#03C3EC", "#696CFF"],
            },
          },
        };

        var data = [];
        for (var i = 0; i < $scope.super.length; i++) {
          var provinceData = {
            x: $scope.super[i].witel+"("+$scope.super[i].plan_wasman+")",
            y: $scope.super[i].actual_wasman,
            goals: [
              {
                name: "Plan",
                value: parseFloat($scope.super[i].plan_wasman),
                strokeHeight: 5,
                strokeColor: "#696CFF",
              },
            ],
          };
          data.push(provinceData);
        }

        options.series.push({
          name: "Actual",
          data: data,
        });

        document.querySelector("#wasmanChart").innerHTML = ""; // Menghapus elemen HTML chart

        var chart = new ApexCharts(
          document.querySelector("#wasmanChart"),
          options
        );
        chart.render();
      });
    $http
      .get("api/report?data=laporan&start_date=" + date1 + "&end_date=" + date2)
      .then(function (response) {
        $scope.loading = true;
        $scope.laporan = response.data;
      });

      $http
      .get("api/report?data=lokasi&start_date=" + date1 + "&end_date=" + date2)
      .then(function (response) {
        $scope.loading = true;
        $scope.lokasi = response.data;
        console.log($scope.lokasi);
      });
  }

  var today = formatDate(new Date());
  getData(today, today);

  $scope.search = function () {
    var start_date = formatDate(new Date($scope.start_date));
    var end_date = formatDate(new Date($scope.end_date));
    getData(start_date, end_date);
  };

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

  $scope.getSlh = function(){
    $http
    .get("api/slh")
    .then(function (response) {
      $scope.slh = response.data.data;
      console.log($scope.slh);
    });
  }
  $scope.getSlh();
});
