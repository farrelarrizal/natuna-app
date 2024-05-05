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
    <div class="row">
        <ul class="list-inline mb-3 d-flex align-items-center">
            <li class="list-inline-item">
                <div class="avtar avtar-s bg-light-warning">
                    <i class="ti ti-file-text f-20"></i>
                </div>
            </li>
            <li class="list-inline-item text-filter"><h5 class="mb-0">Filter Views</h5></li>
            <li class="list-inline-item mr-4">
                <select class="form-select form-select-sm w-auto">
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
            </li>
            <li class="list-inline-item">
                <select class="form-select form-select-sm w-auto">
                    <option selected="">Region</option>
                    <option>Region 1</option>
                    <option>Region 2</option>
                    <option>Region 3</option>
                    <option>Region 4</option>
                    <option>Region 5</option>
                </select>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-9">
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
                        <p class="text-muted mb-1">Average Score</p>
                        <h5 class="mb-0 p-3 color-block text-blue-500">4,175/5</h5>
                      </div>
                      <div class="col-6">
                        <div id="average-score-graph"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-xl-4">
                    <div class="mt-3 row align-items-center">
                      <div class="col-6">
                        <p class="text-muted mb-1">Naval Deployment</p>
                        <h5 class="mb-0 p-3 color-block text-red-500">3,625/5</h5>
                      </div>
                      <div class="col-6">
                        <div id="naval-deployment-graph"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-xl-4">
                    <div class="mt-3 row align-items-center">
                      <div class="col-6">
                        <p class="text-muted mb-1">Naval Capacity</p>
                        <h5 class="mb-0 p-3 color-block text-green-500">4,485/5</h5>
                      </div>
                      <div class="col-6">
                        <div id="naval-capacity-graph"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Safest Region</h5>
                    </div>
                    <div class="my-3">
                        <div id="safes-region-graph"></div>
                        <h6 class="text-center mt-3">North Natuna <small class="text-primary"><i class="ti ti-arrow-up-right"></i> 30.6%</small></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Natuna Sea Defence and Security Trends</h5>
                </div>
                <div class="pc-component">
                    <div class="alert alert-primary my-3" role="alert">
                        <div class="avtar avtar-s"><i data-feather="alert-circle"></i></div>
                        Information Notes </div>
                </div>
                
                <div class="my-3">
                    <div id="natuna-defsec-trend"></div>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="<?= asset('assets/js/pages/menu/hankam-summary.js') ?>"></script>
@endsection
