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
                <div class="card-header"><h5>Peta Keamanan Hankam Natuna Utara</h5></div>
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
    <script>
        // const map = L.map('map').setView([3.7794758133637623, 107.64262073851498], 8);

        // const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 19,
        //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        // }).addTo(map);

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

        var marker = L.marker([3.344837553047583, 108.26945452592213],{
            draggable: true
        })
        .bindPopup('Kepulauan Natuna')
        .addTo(map);

        var circles = [
            {
                center: [4.842153822801576, 108.10398394340929],
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 10000,
                tooltipContent: '<b>Laut Natuna Utara 1</b><br>----------------------------------------------<br>Level Hankam: Sangat Rentan'
            },
            {
                center: [3.5237929829697916, 106.44578620527722],
                color: 'yellow',
                fillColor: '#d6c633',
                fillOpacity: 0.5,
                radius: 7000,
                tooltipContent: '<b>Laut Natuna Utara 2</b><br>----------------------------------------------<br>Level Hankam: Waspada'
            },
            {
                center: [3.7247767127841884, 108.78061234007701],
                color: 'green',
                fillColor: '#33d664',
                fillOpacity: 0.5,
                radius: 5000,
                tooltipContent: '<b>Laut Natuna Utara 3</b><br>----------------------------------------------<br>Level Hankam: Sangat Aman'
            }
        ];

        var circleGroup = L.layerGroup(); // Create a layer group for circles

        // Loop through the circles array and create circles with tooltips
        circles.forEach(function(circleData) {
            var circle = L.circle(circleData.center, {
                color: circleData.color,
                fillColor: circleData.fillColor,
                fillOpacity: circleData.fillOpacity,
                radius: circleData.radius,
                draggable: true
            }).bindTooltip(circleData.tooltipContent); // bindTooltip instead of bindPopup
            
            circleGroup.addLayer(circle); // Add each circle to the layer group
        });

        var overLayers = {
            'Circle': circleGroup,
            'Marker': marker
             // Add the layer group instead of circles array
        };

        var baseMaps = {
            'Open Street Map':osm,
            'Stadia Alidade':Stadia_AlidadeSatellite,
            'Open Topographic Map':OpenTopoMap
        };

        L.control.layers(baseMaps, overLayers).addTo(map);
    </script>
@endsection