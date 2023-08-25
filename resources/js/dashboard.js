var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $location, $http, $timeout) {
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
    $scope.countPatroli = {
      total_plan_patroli: "Loading..",
      total_actual_patroli: "Loading..",
      persen: 0,
    };
    $http
      .get(
        "api/dashboard?method=patroli&start_date=" +
          date1 +
          "&end_date=" +
          date2
      )
      .then(function (response) {
        $scope.countPatroli = response.data;
        console.log($scope.countPatroli);
      });

    //count wasman
    $scope.countWasman = {
      total_plan_wasman: "Loading..",
      total_actual_wasman: "Loading..",
      persen: 0,
    };
    $http
      .get(
        "api/dashboard?method=wasman&start_date=" + date1 + "&end_date=" + date2
      )
      .then(function (response) {
        $scope.countWasman = response.data;
        console.log($scope.countWasman);
      });

    //count ggn
    //count slh
    //chart patroli
    $http
      .get(
        "api/dashboard?method=chart_patroli&start_date=" +
          date1 +
          "&end_date=" +
          date2
      )
      .then(function (response) {
        $scope.chartPatroli = response.data;
        console.log($scope.chartPatroli);
        var options = {
          series: [],
          chart: {
            height: 550,
            type: "bar",
            events: {
              dataPointSelection: function (event, chartContext, config) {
                window.location.href = "/frotect-website/plan";
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

        for (var i = 0; i < $scope.chartPatroli.length; i++) {
          var provinceData = {
            x: $scope.chartPatroli[i].witel,
            y: $scope.chartPatroli[i].actual,
            goals: [
              {
                name: "Plan",
                value: parseFloat($scope.chartPatroli[i].plan),
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
        
        document.querySelector("#patroliChart").innerHTML = ''; // Menghapus elemen HTML chart

        var chart = new ApexCharts(
          document.querySelector("#patroliChart"),
          options
        );
        chart.render();
      });

    //chart wasman
    $http
      .get(
        "api/dashboard?method=chart_wasman&start_date=" +
          date1 +
          "&end_date=" +
          date2
      )
      .then(function (response) {
        $scope.chartWasman = response.data;
        console.log($scope.chartWasman);
        var options = {
          series: [],
          chart: {
            height: 550,
            type: "bar",
            events: {
              dataPointSelection: function (event, chartContext, config) {
                window.location.href = "/frotect-website/plan";
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

        for (var i = 0; i < $scope.chartWasman.length; i++) {
          var provinceData = {
            x: $scope.chartWasman[i].witel,
            y: $scope.chartWasman[i].actual,
            goals: [
              {
                name: "Plan",
                value: parseFloat($scope.chartWasman[i].plan),
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

        document.querySelector("#wasmanChart").innerHTML = '';

        var chart = new ApexCharts(
          document.querySelector("#wasmanChart"),
          options
        );
        chart.render();
      });

    //konsistensi patroli dan wasman
    $scope.laporan = {
      witel: "Loading..",
      laporan: 0,
    };
    $http
      .get(
        "api/dashboard?method=laporan&start_date=" +
          date1 +
          "&end_date=" +
          date2
      )
      .then(function (response) {
        $scope.laporan = response.data;
        console.log($scope.laporan);
      });

    $scope.lokasi = {
      witel: "Loading..",
      laporan: 0,
      lokasi :0
    };
    $http
      .get(
        "api/dashboard?method=lokasi&start_date=" + date1 + "&end_date=" + date2
      )
      .then(function (response) {
        $scope.lokasi = response.data;
        console.log($scope.laporan);
      });
  }

  var today = formatDate(new Date());
  getData(today, today);

  $scope.search = function () {
    var start_date = formatDate(new Date($scope.start_date));
    var end_date = formatDate(new Date($scope.end_date));
    getData(start_date, end_date);
  };
});
