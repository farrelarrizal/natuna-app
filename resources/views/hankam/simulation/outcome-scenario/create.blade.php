@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>">
<link rel="stylesheet" href="<?= asset('assets/css/plugins/bootstrap-slider.min.css') ?>">
<link rel="stylesheet" href="<?= asset('assets/css/uikit.css') ?>">
<link rel="stylesheet" href="<?= asset('assets/css/plugins/nouislider.min.css') ?>">
@endsection
@php
    $uniqueItems = $dataVariable->unique('id');
@endphp
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
                <h5 class="mb-0">{{ $head_title }} - {{ $scenario->name }}</h5>
                <span>SFD: {{ $scenario->sfd->name }}</span>
            </li>
        </ul>
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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Outcome Scenario Data</h5>

            </div>
            <div class="card-body">
                <form action="{{ route('hankam.simulation.outcome-scenario.storeOutcome') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="scenario_id" value="{{ $scenario->id }}">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Variable</label>
                            <select name="variable_id" class="form-select">
                                <option selected disabled>Select Variable</option>
                                @foreach($uniqueItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="file" class="form-label">Upload Excel</label>
                            <input name="file" type="file" id="file" class="form-control" required />
                        </div>
                        <div class="col-lg-12 mb-3">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('hankam.simulation.outcome-scenario.detail', ['id' => $scenario->id]) }}'">Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
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
