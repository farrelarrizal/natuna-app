@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Dashboard</h5></div>
                <div class="card-body">
                    Halaman Dashboard
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection