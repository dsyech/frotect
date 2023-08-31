var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $location, $http) {
  $scope.loading = false;
  $scope.super = [];
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

  function getData(date1, date2) {
    $scope.loading = false;
    console.log(date1);
    console.log(date2);

    $http
      .get("api/report?data=all&start_date=" + date1 + "&end_date=" + date2)
      .then(function (response) {
        console.log(response.data);
        $scope.total_plan_patroli = response.data.total_plan_patroli;
        $scope.total_plan_wasman = response.data.total_plan_wasman;
        $scope.total_actual_patroli = response.data.total_actual_wasman;
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
            height: 550,
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
            x: $scope.super[i].witel,
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
            height: 550,
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
            x: $scope.super[i].witel,
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
      .get("api/report?start_date=" + date1 + "&end_date=" + date2)
      .then(function (response) {
        $scope.loading = true;
        $scope.super = response.data;
        //chart wasman
        var options = {
          series: [],
          chart: {
            height: 550,
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
            x: $scope.super[i].witel,
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

    //count ggn
    //count slh
  }

  var today = formatDate(new Date());
  getData(today, today);

  $scope.search = function () {
    var start_date = formatDate(new Date($scope.start_date));
    var end_date = formatDate(new Date($scope.end_date));
    getData(start_date, end_date);
  };
});
