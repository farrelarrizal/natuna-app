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
  <div class="row col-lg-12">
    <div class="row">
      <h3>Actual North Natuna Indicator</h3>
      @if($all_indicator == 'HIGH')
        <div class="alert alert-success d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Well Done! The actual indicator is <strong>{{$all_indicator}}</strong>. Keep up the good work!</div>
        </div>
      @elseif($all_indicator == 'MEDIUM')
        <div class="alert alert-success d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Well Done! The actual indicator is <strong>{{$all_indicator }}</strong>. Keep up the good work!
        </div>
      @elseif($all_indicator == 'LOW')
        <div class="alert alert-warning d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Warning! The actual indicator is <strong>{{$all_indicator }}</strong>. Keep up the good work!
        </div>
      @elseif($all_indicator == 'DANGER')
        <div class="alert alert-danger d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Danger! The actual indicator is <strong>{{$all_indicator }}</strong>. Keep up the good work!</div>
        </div>
      @elseif($all_indicator == 'VERY LOW')
        <div class="alert alert-danger d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Danger! The actual indicator is <strong>{{ $all_indicator }}</strong>. Keep up the good work!</div>
        </div>
      @else
        <div class="alert alert-info d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>There is no actual indicator</div>
        </div>
      @endif
    </div>
    <div class="d-flex ">
      <div class="col-3 p-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s bg-light-primary">
                  <i class="fas fa-shield-alt"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-0">North Natuna Defense and Security</h6>
              </div>
            </div>
            <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>{{ round($first_var, 0) }}</strong><small>/100</small></h3>
                  <p class="text-primary mb-0">
                    @if($first_var < 50)
                      <span class="badge bg-light-danger mb-0 mt-1 text-md">Low</span>
                      @elseif($first_var >=50 && $first_var < 70)
                      <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                      @else
                      <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                    @endif
                  </p>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
      <div class="col-3 p-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s bg-light-primary">
                  <i class="fas fa-shield-alt"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-0">National Defense and Security Infrastructure</h6>
              </div>
            </div>
            <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>{{round($second_var)}}</strong><small>/100</small></h3>
                  <p class="text-primary mb-0">
                    @if($second_var < 50)
                      <span class="badge bg-light-danger mb-0 mt-1 text-md">Low</span>
                      @elseif($second_var >=50 && $second_var < 70)
                      <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                      @else
                      <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                    @endif
                  </p>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
      <div class="col-3 p-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s bg-light-primary">
                  <i class="fas fa-shield-alt"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-0">Marine Resource Utilization</h6>
              </div>
            </div>
            <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>{{round($third_var)}}</strong><small>/100</small></h3>
                  <p class="text-primary mb-0">
                    @if($third_var < 50)
                    <span class="badge bg-light-danger mb-0 mt-1 text-md">Low</span>
                    @elseif($third_var >=50 && $third_var < 70)
                    <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                    @else
                    <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                  @endif                  
                </p>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
      <div class="col-3 p-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s bg-light-primary">
                  <i class="fas fa-shield-alt"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-0 text-justify">National Sea Threat Risk</h6>
              </div>
            </div>
            <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>{{round($fourth_var)}}</strong><small>/100</small></h3>
                  <p class="text-primary mb-0">
                    @if($fourth_var < 50)
                      <span class="badge bg-light-danger mb-0 mt-1 text-md">Low</span>
                      @elseif($fourth_var >=50 && $fourth_var < 70)
                      <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                      @else
                      <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                    @endif
                  </p>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
    </div>
    <div>
      
      <div class="row col-lg-12">
        <div class="row d-flex justify-content-between">
          <div class="col d-flex justify-content-between">
            <h3>Forecast North Natuna Indicator</h3>
            <!-- SELECT LIST -->
            <form id="myForm" action="" method="GET">
              <div class="list-inline">
                  <select id="scenarioSelect" class="form-select text-filter">
                      @foreach($scenarios as $scenario)
                          <option value="{{ $scenario->id }}">{{ $scenario->name }}</option>
                      @endforeach
                  </select>
              </div>
          </form>
          </div>
        </div>
        @if($recommendation_id->klasifikasi == 'HIGH')
        <div class="alert alert-success d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Well Done! The forecast indicator is <strong>{{$recommendation_id->klasifikasi}}</strong>. Keep up the good work!</div>
        </div>
      @elseif($recommendation_id->klasifikasi == 'MEDIUM')
        <div class="alert alert-success d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Well Done! The forecast indicator is <strong>{{$recommendation_id->klasifikasi }}</strong>. Keep up the good work!</div>
        </div>
      @elseif($recommendation_id->klasifikasi == 'LOW')
        <div class="alert alert-warning d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Warning! The forecast indicator is <strong>{{$recommendation_id->klasifikasi }}</strong>. Keep up the good work!</div>
        </div>
      @elseif($recommendation_id->klasifikasi == 'DANGER')
        <div class="alert alert-danger d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Danger! The forecast indicator is <strong>{{$recommendation_id->klasifikasi }}</strong>. Keep up the good work!</div>
        </div>
      @elseif($recommendation_id->klasifikasi == 'VERY LOW')
        <div class="alert alert-danger d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>Danger! The forecast indicator is <strong>{{ $recommendation_id->klasifikasi }}</strong>. Keep up the good work!</div>
        </div>
      @else
        <div class="alert alert-info d-flex align-items-center mt-2 mx-2" role="alert">
          <i class="fas fa-info-circle me-2"></i>
          <div>There is no actual indicator</div>
        </div>
      @endif
      
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-primary">
                    <!-- fas fa-ship -->
                    <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">Defence and Security Score</h6>
                </div>
              </div>
              <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>{{ round($forecast_first_var)}}</strong>/100</h3>
                  <p class="text-primary mb-0">
                    <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                  </p>
                </div>
              </div>
            </div>            
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-primary">
                    <!-- fas fa-ship -->
                    <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">National Defense and Security Infrastructure</h6>
                </div>
              </div>
              <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>{{ round($forecast_second_var)}}</strong>/100</h3>
                  <p class="text-primary mb-0">
                    @if($forecast_second_var < 50)
                    <span class="badge bg-light-danger mb-0 mt-1 text-md">Low</span>
                    @elseif($forecast_second_var >=50 && $forecast_second_var < 70)
                    <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                    @else
                    <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                    @endif
                  </p>
                </div>
              </div>
            </div>            
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-primary">
                    <!-- fas fa-ship -->
                    <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">Marine Resource Utilization</h6>
                </div>
              </div>
              <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>{{ round($forecast_third_var)}}</strong>/100</h3>
                  <p class="text-primary mb-0">
                    @if($forecast_third_var < 50)
                    <span class="badge bg-light-danger mb-0 mt-1 text-md">Low</span>
                    @elseif($forecast_third_var >=50 && $forecast_third_var < 70)
                    <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                    @else
                    <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                    @endif
                  </p>
                </div>
              </div>
            </div>            
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-primary">
                    <!-- fas fa-ship -->
                    <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">National Sea Threat Risk</h6>
                </div>
              </div>
              <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>{{ round($forecast_fourth_var)}}</strong>/100</h3>
                  <p class="text-primary mb-0">
                    @if($forecast_fourth_var < 50)
                    <span class="badge bg-light-danger mb-0 mt-1 text-md">Low</span>
                    @elseif($forecast_fourth_var >=50 && $forecast_fourth_var < 70)
                    <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                    @else
                    <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                    @endif
                  </p>
                </div>
              </div>
            </div>            
            </div>
          </div>
        </div>
      </div>
    </div>


      <br>
      <hr>
      <div class="card ">
        <div class="card-header">
          <h3 class="mb-0">Analisis Kondisi Eksisting</h3>
        </div>
        <div class="card-body">
          {!!  $recommendation_id->analisa_kondisi !!}
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">
            <div class="col d-flex">
              <h3> Ancaman 
              </h3>
            </div>
          </h3>
        </div>
        <div class="card-body">
          <!-- read html tag from db -->
          {!!  $ancaman_id[0]->text !!}
        </div>
      </div>
      <div class="card ">
        <div class="card-header">
          <h3 class="mb-0">Rekomendasi</h3>
        </div>
        <div class="card-body">
          {!!  $recommendation_id->rekomendasi !!}
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">
            <div class="col d-flex">
              <h3> Alternative Skenario 
              </h3>
            </div>
          </h3>
        </div>
        <div class="card-body">
          <h4>North Natuna Defense and Security</h4>
          {!! $solution_first_var->solusi !!}
          <br>
          <h4>National Defense and Security Infrastructure</h4>
          {!! $solution_second_var->solusi !!}
          <br>
          {{-- <h4>North Natuna Defense and Security</h4>
          {!! $solution_third_var->solusi !!}
          <br>
          <h4>North Natuna Defense and Security</h4>
          {!! $solution_fourth_var ->solusi!!}
          <br> --}}
      </div>
      
      

      {{-- <div class="col-md-12">
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
      </div> --}}

  </div>
@endsection

@section('script')
    <script src="<?= asset('assets/js/pages/menu/executive-summary.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/datepicker-full.min.js') ?>"></script>
    <script>
      document.getElementById('scenarioSelect').addEventListener('change', function() {
          var selectedValue = this.value; // Get the selected value
          var form = document.getElementById('myForm'); // Get the form element
          var baseUrl = '{{ route("dashboard.executive-summary-scenario", "scenario_id") }}'; // Get the base URL

          // Update the form's action attribute with the selected scenario ID
          form.action = baseUrl.replace('scenario_id', selectedValue);

          // Submit the form
          form.submit();
      });
  </script>
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