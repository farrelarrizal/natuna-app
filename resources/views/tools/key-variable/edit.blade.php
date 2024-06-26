@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>" >
@endsection

@section('content')
@include('partials/breadcrumb')
<div class="row">
    <div class="col-md-12 mb-3">
      <div class="d-flex align-items-center justify-content-between">
          <ul class="list-inline mb-3 d-flex align-items-center">
              <li class="list-inline-item">
                  <div class="avtar avtar-s bg-light-warning">
                      <i class="ti ti-artboard f-20"></i>
                  </div>
              </li>
              <li class="list-inline-item text-filter">
                  <h5 class="mb-0">Key Variable</h5>
                  <span>Last Edit: 17 May 2024 18:50</span>
              </li>
          </ul>
          
      </div>
    </div>
    <div class="col-md-12">
        @if (session('success'))
            
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
          <div class="card-header">
            <h5>Edit Parameters</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('tools.key-variable.update', ['variable' => $variable->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Model ID:</strong>
                            <input type="number" name="model_id" value="{{ $variable->model_id }}" class="form-control" placeholder="Model ID">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" value="{{ $variable->name }}" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Key Variable:</strong>
                            <input type="checkbox" name="key_variable" value="1" {{ $variable->key_variable ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            
          </div>
        </div>
    </div>
</div>
            
</div>
@endsection

@section('script')
@endsection