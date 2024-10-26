'use strict';
document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    floatchart();
  }, 500);
});

  (function () {
    fetch('/api/base-model-graph-data')
        .then(response => response.json())
        .then(data => {
            var series = data.data.map(item => {
                return {
                    name: item.variable_name ,
                    data: item.values
                };
            });

            var options = {
                chart: {
                    fontFamily: 'Inter var, sans-serif',
                    type: 'area',
                    height: 370,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#0d6efd', '#63C3EC'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        type: 'vertical',
                        inverseColors: false,
                        opacityFrom: 0.2,
                        opacityTo: 0
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 3
                },
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        borderRadius: 4
                    }
                },
                grid: {
                    show: true,
                    borderColor: '#F3F5F7',
                    strokeDashArray: 2
                },
                series: series,
                xaxis: {
                    categories: data.data[0].node_points.map(String), // Ambil node_points dari data pertama
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector('#defence-and-security-graphics'), options);
            chart.render();
        });
})();


  (function () {
    var options = {
      chart: {
        fontFamily: 'Inter var, sans-serif',
        type: 'area',
        height: 370,
        toolbar: {
          show: false
        }
      },
      colors: ['#0244A7', '#4680FF', '#63C3EC'],
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 1,
          type: 'vertical',
          inverseColors: false,
          opacityFrom: 0.2,
          opacityTo: 0
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 3
      },
      plotOptions: {
        bar: {
          columnWidth: '45%',
          borderRadius: 4
        }
      },
      grid: {
        show: true,
        borderColor: '#F3F5F7',
        strokeDashArray: 2
      },
      series: [
        {
          name: 'Variable 1',
          data: [2, 2.5, 3, 2.5, 4.5, 4, 2, 4, 2, 3, 3.5, 4]
        },
        {
          name: 'Variable 2',
          data: [0, 3.5, 2, 3.5, 3.7, 4.5, 2.5, 2.7, 2.2, 2, 3.5, 3.2]
        },
         {
          name: 'Variable 3',
          data: [1.5, 3, 2, 3, 3.5, 4.5, 2.8, 1.8, 2.8, 5.5, 3.5, 2.5]
        }
      ],
      xaxis: {
        categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
        axisBorder: {
          show: true
        },
        axisTicks: {
          show: true
        }
      }
    };
    var chart = new ApexCharts(document.querySelector('#outcome-scenario-detail'), options);
    chart.render();
  })();