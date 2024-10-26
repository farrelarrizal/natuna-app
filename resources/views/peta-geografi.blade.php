@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Peta Natuna</h5></div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet@latest/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-providers@latest/leaflet-providers.js"></script>
    <script>
        // const map = L.map('map').setView([3.7794758133637623, 107.64262073851498], 8);

        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        })

        var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
        });

        var Stadia_AlidadeSatellite = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.{ext}', {
            minZoom: 0,
            maxZoom: 20,
            attribution: '&copy; CNES, Distribution Airbus DS, © Airbus DS, © PlanetObserver (Contains Copernicus Data) | &copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            ext: 'jpg'
        });

        var map = L.map('map', {
            center: [3.7794758133637623, 107.64262073851498],
            zoom: 8,
            layers: [osm]
        });

        var baseMaps = {
            'Open Street Map':osm,
            'Stadia Alidade':Stadia_AlidadeSatellite,
            'Open Topographic Map':OpenTopoMap
        };

        var marker = L.marker([3.344837553047583, 108.26945452592213],{
            draggable: true
        })
        .bindPopup('Kepulauan Natuna')
        .addTo(map);

        var overLayers = {
            'Marker': marker
        };

        L.control.layers(baseMaps, overLayers).addTo(map);
    </script>
@endsection