@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="<?= asset('assets/css/plugins/datepicker-bs5.min.css') ?>">
    <style>
        .list-inline .text-filter{
            margin-right: 50px;
        }
    </style>
@endsection

@section('content')
@include('partials/breadcrumb')
  <div class="row mb-2">
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Natuna overview</h5>
                <div class="dropdown">
                  <a
                    class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none"
                    href="#"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="ti ti-dots f-18"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">Today</a>
                    <a class="dropdown-item" href="#">Weekly</a>
                    <a class="dropdown-item" href="#">Monthly</a>
                  </div>
                </div>
              </div>
              <div class="row align-items-center justify-content-center">
                <div class="col-md-4 col-xl-4">
                  <div class="mt-3 row align-items-center">
                    <div class="col-12">
                      <p class="text-muted mb-1">Defence and Security Score</p>
                      <h5 class="mb-0 p-3 color-block text-blue-500">{{ $first_var}}/100</h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-4">
                  <div class="mt-3 row align-items-center">
                    <div class="col-12">
                      <p class="text-muted mb-1">National Defense and Security Infrastructure</p>
                      <h5 class="mb-0 p-3 color-block text-red-500">{{ $second_var }}/5</h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-4">
                  <div class="mt-3 row align-items-center">
                    <div class="col-12">
                      <p class="text-muted mb-1">Marine Resource Utilizatio</p>
                      <h5 class="mb-0 p-3 color-block text-green-500">{{ $third_var }}/5</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-0">Defence and Security Score</h5>
              <div id="defsec-graph"></div>
            </div>
          </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0">National Defense and Security Infrastructure</h5> 
            </div>
            <div class="row my-3">
                <div id="national-defsec-graph"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-0">Marine Resource Utilizatio</h5>
              <div id="marine-resource-graph"></div>
            </div>
          </div>
      </div>
  </div>
@endsection

@section('script')
    <script src="<?= asset('assets/js/pages/menu/executive-summary.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/datepicker-full.min.js') ?>"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        function generateColors(numScenarios) {
            const baseColors = ['#0d6efd', '#63C3EC', '#ff6347', '#6a5acd']; // Add more colors if needed
            return baseColors.slice(0, numScenarios);
        }

        function renderGraph(containerId, varValue) {
            fetch(`/api/scenario-graph-data/${varValue}`)
                .then(response => response.json())
                .then(data => {
                    if (data.data.length === 0) {
                        document.querySelector(`#${containerId}`).innerHTML = `<p>There are no scenarios on variable <i> ${varValue} </i></p>`;
                        return;
                    }

                    const numScenarios = data.data.length;
                    const colors = generateColors(numScenarios);

                    const series = data.data.map(item => ({
                        name: item.scenario_name,
                        data: item.values
                    }));

                    const xaxisCategories = data.data.length > 0 ? data.data[0].node_points.map(String) : [];

                    const options = {
                        chart: {
                            fontFamily: 'Inter var, sans-serif',
                            type: 'area',
                            height: 370,
                            toolbar: {
                                show: false
                            }
                        },
                        colors: colors,
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                type: 'vertical',
                                inverseColors: false,
                                opacityFrom: 0.3,
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
                            strokeDashArray: 4
                        },
                        series: series,
                        xaxis: {
                            categories: xaxisCategories,
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                show: true,
                                step: 2 // Display every 2 data points
                            },
                            tickAmount: Math.floor(xaxisCategories.length / 10) // Adjust tick amount
                        }
                    };

                    document.querySelector(`#${containerId}`).innerHTML = '';

                    const chart = new ApexCharts(document.querySelector(`#${containerId}`), options);
                    chart.render();
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.querySelector(`#${containerId}`).innerHTML = '<p>Belum ada skenario pada variabel</p>';
                });
        }

        // Call the function for each graph
        renderGraph('defsec-graph', 'North Natuna Defense and Security');
        renderGraph('national-defsec-graph', '(National Defense and Security Infrastructure');
        renderGraph('marine-resource-graph', 'Marine Resource Utilizatio')
    });
    </script>
@endsection