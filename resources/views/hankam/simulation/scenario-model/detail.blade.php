@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>" >
        <link rel="stylesheet" href="<?= asset('assets/css/plugins/bootstrap-slider.min.css') ?>" >
        <link rel="stylesheet" href="<?= asset('assets/css/uikit.css') ?>" >
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row mb-3">
        <div class="d-flex align-items-center justify-content-between">
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
    </div>
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Scenario Detail</h5>
              
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <p class="mb-1">Scenario Name</p>
                    <div class="alert alert-secondary" role="alert">Scenario Version 1</div>
                  </div>
                </div>
                <div class="row">
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
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <p class="mb-1">Hybrid Threats</p>
                    <div class="alert alert-secondary" role="alert">A FUNCTION OF( Disinformation Campaign,Proxy,Social Media Attack)</div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-12">
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
                  {{-- <div class="col-md-6">
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
                </div>
                <button type="submit" class="btn btn-primary">Add Scenario</button>
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
@endsection