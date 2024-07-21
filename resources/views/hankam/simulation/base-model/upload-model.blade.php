@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>" >
@endsection

@section('content')
@include('partials.breadcrumb')
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
                    <h5 class="mb-0">Upload Model</h5>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Upload Model</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('hankam.simulation.base-model.uploadModel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" id="desc" class="form-control" placeholder="Description" required></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Is Active
                        </label>
                    </div>
                    <div class="fallback mb-3">
                        <input name="file" type="file" id="file" required />
                    </div>
                    <button type="submit" class="btn btn-primary mb-4">Upload Model and File</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
