@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>" >
        <link rel="stylesheet" href="<?= asset('assets/css/plugins/bootstrap-slider.min.css') ?>" >
        <link rel="stylesheet" href="<?= asset('assets/css/uikit.css') ?>" >
        <link rel="stylesheet" href="<?= asset('assets/css/plugins/nouislider.min.css') ?>">
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row mb-3">
        <div class="col-sm-5">
          <ul class="list-inline mb-3 d-flex align-items-center">
              <li class="list-inline-item">
                  <div class="avtar avtar-s bg-light-warning">
                      <i class="ti ti-artboard f-20"></i>
                  </div>
              </li>
              <li class="list-inline-item text-filter">
                  <h5 class="mb-0">Defense and Security Scenario Model</h5>
              </li>
          </ul> 
        </div>
        <div class="col-sm-7">
          {{-- <form action="" method="post">
            <select name="" id="" class="form-select">
              <option selected>Select SFD</option>
                <option value="sfd-1">SFD 1</option>
                <option value="sfd-2">SFD 2</option>
                <option value="sfd-3">SFD 3</option>
            </select>
          </form> --}}
      </div>  
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- Display success message -->
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <!-- Display error message -->
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <!-- Display validation errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
      </div>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Add Scenario Details</h5>
            </div>
            <div class="card-body">
            <form action="{{route('hankam.simulation.scenario-model.storeScenario')}}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Model (Stock Flow Diagram)</label>
                    <select name="sfd_id" id="" class="form-select">
                        <option selected disabled>Select SFD</option>
                            @foreach ($rowSfd as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>  
                            @endforeach
                      </select>
                  </div>
                  <div class="col-lg-12 mb-3">
                    <label class="form-label">Scenario Name</label>
                    <input class="form-control" type="text" name="name" id="">
                  </div>

                  <div class="col-lg-12 mb-3">
                    <label class="form-label">Scenario Detail</label>
                    <textarea class="form-control" name="desc" id="" cols="10" rows="3"></textarea>
                  </div>
                  <div class="col-lg-12 mb-3">
                    <label class="form-label">Final Time</label>
                    <input class="form-control" type="number" name="timestep" id="" value="132">
                  </div>
                  <div class="col-lg-12 mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
            </form>
                {{-- <div class="row">
                  <div class="col-lg-6">
                    <p class="mb-1">Naval defense posture (percentage)</p>
                    <div class="alert alert-secondary" role="alert">percentage</div>
                  </div>
                  <div class="col-lg-6">
                    <p class="mb-1">Naval Strength</p>
                    <div class="alert alert-secondary" role="alert">A FUNCTION OF( Integrated Force)</div>
                  </div>
                </div>
                  
                <div class="row">
                  <div class="col-lg-6">
                    <p class="mb-1">Harbour</p>
                    <div class="alert alert-secondary" role="alert">A FUNCTION OF( National Defense and Security Infrastructure,Recreation,Refulling\,Repair,Replenishment,Rest)</div>
                  </div>
                  <div class="col-lg-6">
                    <p class="mb-1">Development Program</p>
                    <div class="alert alert-secondary" role="alert">A FUNCTION OF( Manufacturing Improvement,Technological Innovation\)</div>
                  </div>
                </div> --}}
                {{-- <div class="row">
                  <div class="col-lg-6">
                    <p class="mb-1">Hybrid Threats</p>
                    <div class="alert alert-secondary" role="alert">A FUNCTION OF( Disinformation Campaign,Proxy,Social Media Attack)</div>
                  </div>
                </div> --}}
              </form>
            </div>
          </div>
        </div>
        {{-- <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5>Time</h5>
            </div>
            <div class="card-body">
              <form action="">
                <div class="form-group row">
                  
                  <div class="col-md-2">
                    <p>Final Time:</p>
                  </div>
                  <div class="col-md-6">
                    <input
                      id="ex8"
                      data-slider-id="ex1Slider"
                      type="text"
                      data-slider-min="0"
                      data-slider-max="20"
                      data-slider-step="1"
                      data-slider-value="14"
                    >
                  </div>
                  <label class="col-form-label col-lg-3 col-sm-12">Basic Setup</label>
                  <div class="col-lg-6 col-md-12 col-sm-12">
                    
                      <div class="row align-items-center">
                        <div class="col-4">
                          <input type="text" class="form-control" id="pc-no_ui_slider-1-input" placeholder="Quantity">
                        </div>
                        <div class="col-8">
                          <div id="pc-no_ui_slider-1" class="pc-no_ui_slider--drag-danger"></div>
                        </div>
                      </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Scenario</button>
              </form>
            </div>
          </div>
        </div> --}}
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= asset('assets/js/plugins/bootstrap-slider.min.js') ?>"></script>
    <script src="<?= asset('assets/js/pages/ac-rangeslider.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/wNumb.min.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/nouislider.min.js') ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
          var variableSelect = document.getElementById('variableSelect');
          var variableForm = document.getElementById('variableForm');

          function loadVariables() {
              fetch('/api/get-variables-active')
                  .then(response => response.json())
                  .then(variables => {
                      variables.forEach(variable => {
                          var option = document.createElement('option');
                          option.value = variable.id;
                          option.textContent = 'Variable '+ variable.id + ' (' + variable.name + ')';
                          variableSelect.appendChild(option);
                      });

                      if (variables.length > 0) {
                          fetchAndRenderGraph(variables[0].id);
                      }
                  })
                  .catch(error => console.error('Error loading variables:', error));
          }

          function fetchAndRenderGraph(variableId) {
              fetch(`/api/base-model-graph-data?variableId=${variableId}`)
                  .then(response => response.json())
                  .then(data => {
                      if (data.data.length === 0) {
                          document.querySelector('#defence-and-security-graphics').innerHTML = '<p>Belum ada skenario pada variabel</p>';
                          return;
                      }

                      function generateColors(numScenarios) {
                          const baseColors = ['#0d6efd', '#63C3EC', '#ff6347', '#6a5acd']; // Tambahkan lebih banyak warna jika diperlukan
                          return baseColors.slice(0, numScenarios);
                      }

                      const numScenarios = data.data.length;
                      const colors = generateColors(numScenarios);

                      var series = data.data.map(item => {  
                          return {
                              name: item.scenario_name,
                              data: item.values
                          };
                      });

                      const xaxisCategories = data.data[0].node_points.map(String);

                      var options = {
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
                                  step: 2 // Tampilkan setiap 2 titik data pada sumbu x
                              },
                              tickAmount: Math.floor(xaxisCategories.length / 10) // Mengatur jumlah tick pada sumbu x
                          }
                      };

                      document.querySelector('#defence-and-security-graphics').innerHTML = '';

                      var chart = new ApexCharts(document.querySelector('#defence-and-security-graphics'), options);
                      chart.render();
                  })
                  .catch(error => {
                      console.error('Error fetching data:', error);
                      document.querySelector('#defence-and-security-graphics').innerHTML = '<p>Belum ada skenario pada variabel</p>';
                  });
          }

          loadVariables();

          variableForm.addEventListener('submit', function (event) {
              event.preventDefault();
              var variableId = variableSelect.value;
              fetchAndRenderGraph(variableId);
          });
      });

      (function () {
        // init slider
        var slider = document.getElementById('pc-no_ui_slider-1');

        noUiSlider.create(slider, {
          start: [0],
          step: 35,
          range: {
            min: [0],
            max: [135]
          },
          format: wNumb({
            decimals: 0
          }),
          tooltips: [
            true,
            wNumb({
              decimals: 1
            })
          ],
        });

        // init slider input
        var sliderInput = document.getElementById('pc-no_ui_slider-1-input');

        slider.noUiSlider.on('update', function (values, handle) {
          sliderInput.value = values[handle];
        });

        sliderInput.addEventListener('change', function () {
          slider.noUiSlider.set(this.value);
        });
      })();
      
      
    </script>
@endsection