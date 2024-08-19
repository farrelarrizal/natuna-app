@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>">
<link rel="stylesheet" href="<?= asset('assets/css/plugins/bootstrap-slider.min.css') ?>">
<link rel="stylesheet" href="<?= asset('assets/css/uikit.css') ?>">
<link rel="stylesheet" href="<?= asset('assets/css/plugins/nouislider.min.css') ?>">
@endsection

@section('content')
@include('partials/breadcrumb')
<div class="row mb-3">
    <div class="col-sm-6">
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
    <div class="col-sm-6">
      <div class="form-group">
          <label for="sfd_id" class="form-label">Selected SFD:</label>
          <p class="form-control-plaintext">
              @if($scenario && $scenario->sfd)
                  {{ $scenario->sfd->name }}
              @else
                  <em>No SFD selected</em>
              @endif
          </p>
      </div>
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
                    <div class="col-lg-6">
                        <p class="mb-1">Scenario Name</p>
                        <div class="alert alert-secondary" role="alert">{{ $scenario->name }}</div>
                    </div>
                    <div class="col-lg-6">
                        <p class="mb-1">Scenario Desc</p>
                        <div class="alert alert-secondary" role="alert">{{ $scenario->desc }}</div>
                    </div>
                </div>                
            </div>            
          </div>
        </div>        
    </div>
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>Variabel Details</h5>
      </div>
        <div class="card-body">
          <div class="form-group row">
              @foreach($dataVariable as $items)
                  <div class="col-lg-6">
                      @if($items->key_variable == 1)
                          <label class="form-label">
                              <span class="badge bg-light-primary" style="font-size: 14px;">
                                  {{ $items->name }} ({{ $items->level }})
                              </span>
                          </label>
                      @else
                          <label class="form-label">
                              {{ $items->name }}
                              @if($items->level !== 'NULL')
                                  ({{ $items->level }})
                              @endif
                          </label>
                      @endif
                      <p class="form-control-plaintext">{{ $items->value }}</p>
                      <small class="form-text text-muted">Value of variable</small>
                  </div>
              @endforeach
          </div>
      </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Final Time</h5>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-group row">

                    {{-- <div class="col-md-2">
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
                  </div> --}}
                    <label class="col-form-label col-lg-3 col-sm-12">Final Time (Month):   {{ $scenario->timestep }}</label>
                    <div class="col-lg-6 col-md-12 col-sm-12">

                        {{-- <div class="row align-items-center">
                            <div class="col-4">
                                <input type="text" class="form-control" id="pc-no_ui_slider-1-input" placeholder="0">
                                {{ $scenario->timestep }}
                            </div>
                            <div class="col-8">
                                <div id="pc-no_ui_slider-1" class="pc-no_ui_slider--drag-danger"></div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                {{-- <button type="submit" class="btn btn-primary">Add Scenario</button> --}}
            </form>
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
