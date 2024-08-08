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
                  <span>Last Edit: 17 May 2024 18:50</span>
              </li>
          </ul> 
        </div>
        <div class="col-sm-7">
          <form action="" method="post">
            <select name="" id="" class="form-select">
              <option selected>Select SFD</option>
                <option value="sfd-1">SFD 1</option>
                <option value="sfd-2">SFD 2</option>
                <option value="sfd-3">SFD 3</option>
            </select>
          </form>
      </div>  
    </div>
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Scenario Details</h5>
              
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-lg-4">
                    <p class="mb-1">Scenario Name</p>
                    <div class="alert alert-secondary" role="alert">{{$dataScenario->name}}</div>
                  </div>
                  <div class="col-lg-4">
                    <p class="mb-1">Time Step</p>
                    <div class="alert alert-secondary" role="alert">{{$dataScenario->timestep}}</div>
                  </div>
                  <div class="col-lg-4">
                    <p class="mb-1">SFD</p>
                    <div class="alert alert-secondary" role="alert">{{$dataScenario->sfd_name}}</div>
                  </div>
                </div>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5>Scenario Variable</h5>
            </div>
            <div class="card-body p-0 income-scroll">
              <div class="mt-3 mb-3">
                <div class="row">
                  @foreach ($rowsScenarioVariable as $item)
                    <div class="col-md-6 px-4">
                      <div class="flex-grow-1 mx-2">
                        
                        <p class="text-muted mb-1">{{$item->name}}({{$item->unit}})</p>
                       
                        <p class="mb-0">{{$item->value}} </p>
                      </div>
                      <hr class="border border-primary-subtle" />
                    </div>
                  @endforeach
                </div>
            </div>
          </div>
      </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= asset('assets/js/plugins/bootstrap-slider.min.js') ?>"></script>
    <script src="<?= asset('assets/js/pages/ac-rangeslider.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/wNumb.min.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/nouislider.min.js') ?>"></script>
    <script>
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