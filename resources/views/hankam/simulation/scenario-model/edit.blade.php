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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Scenario Details</h5>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('hankam.simulation.scenario-model.update-variables', $scenario->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Scenario Name</label>
                            <input class="form-control" type="text" name="name" id="" value="{{ $scenario->name }}">
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Scenario Detail</label>
                            <textarea class="form-control" name="desc" id="" cols="10" rows="3"
                                value="{{ $scenario->desc }}">{{ $scenario->desc }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">SFD</label>
                            <select name="sfd_id" id="" class="form-select">
                                <option selected disabled>Select SFD</option>
                                @foreach($rowSfd as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $scenario->sfd_id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Final Time</label>
                            <input class="form-control" type="number" name="timestep" id="" value="132"
                                value="{{ $scenario->timestep }}">
                        </div>
                        @foreach($dataVariable as $item)
                            <div class="col-lg-6">
                                @if($item->key_variable == 1)
                                    <label class="form-label"><span class="badge bg-light-primary"
                                            style="font-size: 14px;">{{ $item->name }}
                                            ({{ $item->level }})</span></label>
                                @else
                                    <label class="form-label">
                                        {{ $item->name }}
                                        @if($item->level !== 'NULL')
                                            ({{ $item->level }})
                                        @endif
                                    </label>
                                @endif
                                <input type="text" class="form-control" name="values[{{ $item->id }}]"
                                    value="{{ $item->value }}" step="0.001">
                                <small class="form-text text-muted">Please enter value of variable</small>
                            </div>
                        @endforeach

                        <div class="col-lg-12 mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            </form>
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
