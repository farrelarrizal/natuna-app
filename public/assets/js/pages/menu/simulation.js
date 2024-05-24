'use strict';
document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    floatchart();
  }, 500);
});
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
      series: [
        {
          name: 'Parameter 1',
          data: [20, 70, 40, 70, 70, 90, 50, 55, 45, 60, 50, 65]
        },
        {
          name: 'Parameter 2',
          data: [10, 40, 20, 40, 50, 70, 80, 30, 15, 32, 90, 30]
        }
      ],
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
  })();