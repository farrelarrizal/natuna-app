@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="<?= asset('assets/css/plugins/datepicker-bs5.min.css') ?>">
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .list-inline .text-filter{
            margin-right: 50px;
        }
    </style>
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-3 mb-2">
            <ul class="list-inline d-flex align-items-center">
                <li class="list-inline-item">
                    <div class="avtar avtar-s bg-light-warning">
                        <i class="ti ti-file-text f-20"></i>
                    </div>
                </li>
                <li class="list-inline-item text-filter"><h5 class="mb-0">Filter Views</h5></li>
            </ul>
        </div>
        <div class="col-sm-4">
            <div class="input-group date">
                <input type="text" class="form-control" placeholder="Select date" id="pc-datepicker-2">
                <span class="input-group-text">
                    <i class="feather icon-calendar"></i>
                </span>
            </div>
        </div>
        <div class="col-sm-5"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Natuna Defence and Security Maps</h5>
                    </div>
                    <div class="pc-component">
                        <div class="alert alert-primary my-3" role="alert">
                            <div class="avtar avtar-s"><i data-feather="alert-circle"></i></div>
                            Informatin Notes</div>
                    </div>
                    <div class="my-3">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Marine Traffic Maps</h5>
                    </div>
                    <div class="pc-component">
                        <div class="alert alert-primary my-3" role="alert">
                            <div class="avtar avtar-s"><i data-feather="alert-circle"></i></div>
                            Informatin Notes</div>
                    </div>
                    <div class="my-3">
                        <div id="mtmap" style="width: 100%; height: 450px; border: 0;">
                            <script type="text/javascript">
                                width='100%'; // the width of the embedded map in pixels or percentage
                                height='450'; // the height of the embedded map in pixels or percentage
                                border='0'; // the width of the border around the map (zero means no border)
                                shownames='true'; // to display ship names on the map (true or false)
                                latitude='4.110729239932477'; // the latitude of the center of the map, in decimal degrees
                                longitude='108.16539816312209'; // the longitude of the center of the map, in decimal degrees
                                zoom='7'; // the zoom level of the map (values between 2 and 17)
                                maptype='1'; // use 0 for Normal Map, 1 for Satellite, 2 for OpenStreetMap
                                showmenu = false;
                            </script>
                            <script type="text/javascript" src="//www.marinetraffic.com/js/embed.js"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="<?= asset('assets/js/plugins/datepicker-full.min.js') ?>"></script>
    <script src="https://unpkg.com/leaflet-editable@1.2.0/src/Leaflet.Editable.js"></script>
    <script>
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

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
            layers: [osm],
            editable: true // Enable editing
        });

        var marker = L.marker([3.344837553047583, 108.26945452592213], {
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
                popupContent: '<b>Laut Natuna Utara 1</b><br>----------------------------------------------<br>Level Hankam: Sangat Rentan'
            },
            {
                center: [3.5237929829697916, 106.44578620527722],
                color: 'yellow',
                fillColor: '#d6c633',
                fillOpacity: 0.5,
                radius: 7000,
                popupContent: '<b>Laut Natuna Utara 2</b><br>----------------------------------------------<br>Level Hankam: Waspada'
            },
            {
                center: [3.7247767127841884, 108.78061234007701],
                color: 'green',
                fillColor: '#33d664',
                fillOpacity: 0.5,
                radius: 5000,
                popupContent: '<b>Laut Natuna Utara 3</b><br>----------------------------------------------<br>Level Hankam: Sangat Aman'
            }
        ];

        var circleGroup = L.layerGroup(); // Create a layer group for circles

        // Loop through the circles array and create circles with popups
        circles.forEach(function(circleData) {
            var circle = L.circle(circleData.center, {
                color: circleData.color,
                fillColor: circleData.fillColor,
                fillOpacity: circleData.fillOpacity,
                radius: circleData.radius,
                draggable: true,
                editable: true // Enable editing
            }).bindPopup(circleData.popupContent, {
                maxWidth: 300 // Set maximum width for the popup
            }).on('click', function(e) {
                var popupContent = prompt("Edit popup content:", circleData.popupContent);
                if (popupContent !== null) {
                    circleData.popupContent = popupContent;
                    circle.bindPopup(circleData.popupContent, {
                        maxWidth: 300 // Set maximum width for the popup
                    }).openPopup();
                }
            });
            
            circleGroup.addLayer(circle); // Add each circle to the layer group
        });

        var overLayers = {
            'Circle': circleGroup,
            'Marker': marker
        };

        var baseMaps = {
            'Open Street Map': osm,
            'Stadia Alidade': Stadia_AlidadeSatellite,
            'Open Topographic Map': OpenTopoMap
        };

        L.control.layers(baseMaps, overLayers).addTo(map);

        // Load GeoJSON file
        fetch('<?= asset('assets/json/natuna.geojson') ?>')
            .then(response => response.json())
            .then(data => {
                var geoJsonLayer = L.geoJson(data, {
                    onEachFeature: function (feature, layer) {
                        var popupContent = '';
                        if (feature.properties) {
                            if (feature.properties.name === 'PULAUNATUNABESAR') {
                                popupContent = '<b>Pulau Natuna Besar</b><br>Penjelasan: Pulau Natuna Besar adalah pulau terbesar di Kepulauan Natuna dan berfungsi sebagai pusat administrasi dan militer Indonesia di kawasan tersebut. Pulau ini memiliki fasilitas militer termasuk pangkalan angkatan laut dan udara, yang penting untuk mengamankan wilayah perbatasan dan jalur pelayaran.<br><br><i>Sumber daya yang ada di Pulau Natuna Besar: <insert detailed resources information here></i>';
                            } else if (feature.properties.name === 'KARANGUNARANG') {
                                popupContent = '<b>Karang Unarang</b><br>Penjelasan: Karang Unarang adalah lokasi mercusuar dan menjadi titik strategis untuk navigasi dan pemantauan aktivitas laut. Mercusuar ini membantu kapal-kapal dalam menentukan posisi mereka di wilayah yang sering dilalui oleh kapal kargo internasional.<br><br><i>Sumber daya yang ada di Karang Unarang: <insert detailed resources information here></i>';
                            } else if (feature.properties.name === 'ZEE') {
                                popupContent = '<b>Laut Cina Selatan di dekat perbatasan ZEE Indonesia</b><br>Penjelasan: Titik ini merupakan bagian dari perairan yang sering menjadi sengketa di Laut Cina Selatan, di mana terjadi tumpang tindih klaim wilayah antara beberapa negara. Keberadaan militer dan patroli rutin di daerah ini penting untuk mempertahankan hak maritim Indonesia dan memastikan keamanan jalur pelayaran internasional.<br><br><i>Sumber daya yang ada di Laut Cina Selatan: <insert detailed resources information here></i>';
                            } else {
                                popupContent = Object.keys(feature.properties).map(function (key) {
                                    return '<b>' + key + ':</b> ' + feature.properties[key];
                                }).join('<br>');
                            }
                        }
                        layer.bindPopup(popupContent, {
                            maxWidth: 300 // Set maximum width for the popup
                        });
                    }
                }).addTo(map);

                overLayers['GeoJSON Layer'] = geoJsonLayer;
                L.control.layers(baseMaps, overLayers).addTo(map);
            });

        (function () {
            const d_week = new Datepicker(document.querySelector('#pc-datepicker-2'), {
                buttonClass: 'btn'
            });
        })();
    </script>
@endsection




