@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        .list-inline .text-filter{
            margin-right: 50px;
        }
    </style>
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row mb-3">
      <div class="col-sm-4 mb-2">
        <ul class="list-inline mb-3 d-flex align-items-center">
          <li class="list-inline-item">
                <div class="avtar avtar-s bg-light-warning">
                    <i class="ti ti-file-text f-20"></i>
                </div>
            </li>
            <li class="list-inline-item text-filter"><h5 class="mb-0">Filter Views</h5></li>
        </ul>
      </div>
      {{-- <div class="col-sm-4 mb-2">
        <form action="">
          <select class="form-select">
            <option selected="">Year</option>
            <option>January</option>
            <option>February</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>June</option>
            <option>July</option>
            <option>August</option>
            <option>September</option>
            <option>October</option>
            <option>November</option>
            <option>Desember</option>
        </select>
        </form>
      </div>
      <div class="col-sm-4 mb-2">
        <form action="">
            <select class="form-select">
            <option selected="">Region</option>
            <option>Region 1</option>
            <option>Region 2</option>
            <option>Region 3</option>
            <option>Region 4</option>
            <option>Region 5</option>
        </select>
        </form>
        
      </div> --}}
    </div>
    <div class="row">
        <div class="col-md-4">
          <div class="card">
              <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Defence and Security Overview</h5>

                
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
                <div class="col-md-6 col-xl-6">
                  <div class="mt-3 row align-items-center">
                    <div class="col-12">
                      <p class="text-muted mb-1"> North Natuna Sea Risk and Threat Score </p>
                      <h5 class="mb-0 p-3 color-block text-red-500">{{ $second_var }}/5</h5>
                <div class="col-md-4 col-xl-4">
                  <div class="mt-3 row align-items-center">
                    <div class="col-6">
                      <p class="text-muted mb-1">Naval Deployment</p>
                      <h5 class="mb-0 p-3 color-block text-red-500">{{ $naval_deployment }}/5</h5>
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-6 col-xl-6">
                  <div class="mt-3 row align-items-center">
                    <div class="col-12">
                      <p class="text-muted mb-1"> Naval Defense Posture Score</p>
                      <h5 class="mb-0 p-3 color-block text-green-500">{{ $third_var }}/5</h5>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">Defence and Security Overview</h5>
                  
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
                      <div class="col-6">
                        <p class="text-muted mb-1">Naval Strength</p>
                        <h5 class="mb-0 p-3 color-block text-blue-500">{{ $naval_strength}}/100</h5>
                      </div>
                     
                    </div>
                  </div>
                  <div class="col-md-4 col-xl-4">
                    <div class="mt-3 row align-items-center">
                      <div class="col-6">
                        <p class="text-muted mb-1">Naval Deployment</p>
                        <h5 class="mb-0 p-3 color-block text-red-500">{{ $naval_deployment }}/5</h5>
                      </div>
                      
                    </div>
                  </div>
                  <div class="col-md-4 col-xl-4">
                    <div class="mt-3 row align-items-center">
                      <div class="col-6">
                        <p class="text-muted mb-1">Naval Capabilties</p>
                        <h5 class="mb-0 p-3 color-block text-green-500">{{ $naval_capabilities }}/5</h5>
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
              <div class="d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">Naval Strength Graph</h5> 
              </div>
              <div class="row my-3">
                  <div id="naval-strength-graphics"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">Defence and Security Graphics</h5> 
              </div>
              <div class="row my-3">
                  <div id="defence-and-security-graphics"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">North Natuna Sea Risk and Threat Score</h5>
              </div>
              <div class="row my-3">
                  <div id="north-natuna-searisk-graphics"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">Naval Defense Posture Score</h5>
              </div>
              <div class="row my-3">
                  <div id="naval-defense-graphics"></div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="<?= asset('assets/js/pages/menu/hankam-summary.js') ?>"></script>
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
        renderGraph('naval-strength-graphics', 'Naval Strength');
        renderGraph('defence-and-security-graphics', 'North Natuna Defense and Security');
        renderGraph('north-natuna-searisk-graphics', 'National Sea Threat Risk');
        renderGraph('naval-defense-graphics', 'Naval Defense Postur')
    });
    </script>
@endsection
