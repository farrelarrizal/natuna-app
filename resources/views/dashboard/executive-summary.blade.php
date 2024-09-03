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
                      <h5 class="mb-0 p-3 color-block text-blue-500">4,175/5</h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-4">
                  <div class="mt-3 row align-items-center">
                    <div class="col-12">
                      <p class="text-muted mb-1">Infrastruktur Hankam Score</p>
                      <h5 class="mb-0 p-3 color-block text-red-500">3,625/5</h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-4">
                  <div class="mt-3 row align-items-center">
                    <div class="col-12">
                      <p class="text-muted mb-1">Marine Resources Potential Score</p>
                      <h5 class="mb-0 p-3 color-block text-green-500">4,485/5</h5>
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
              <h5 class="mb-0">Defence and Security Sub Model</h5>
              <div id="defsec-sub-graph"></div>
            </div>
          </div>
      </div>
      <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-0">Defence and Security Infrastructure Sub Model</h5>
              <div id="defsec-infra-sub-graph"></div>
            </div>
          </div>
      </div>
      <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-0">Defence and Security Marine Resource Sub Model</h5>
              <div id="defsec-marine-sub-graph"></div>
            </div>
          </div>
      </div>
  </div>
@endsection

@section('script')
    <script src="<?= asset('assets/js/pages/menu/executive-summary.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/datepicker-full.min.js') ?>"></script>
    <script>
      (function () {
        const d_week = new Datepicker(document.querySelector('#pc-datepicker-2'), {
          buttonClass: 'btn'
        });
      })();
    </script>
@endsection