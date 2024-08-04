@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
@include('partials/breadcrumb')
<div class="row mb-3">
    <div class="col-md-12 mb-2">
        <div class="d-flex align-items-center justify-content-between">
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
            <button type="button" class="btn btn-info" onclick="window.location='{{ route('hankam.simulation.outcome-scenario.createOutcome', $scenario->id) }}'">
                <i class="ti ti-square-plus"></i> Import
            </button>                           
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{ $head_title }} Detail</h5>
                </div>
                <div class="pc-component">
                    <div class="alert alert-primary my-3" role="alert">
                        <div class="avtar avtar-s"><i data-feather="alert-circle"></i></div>
                        Information Notes
                    </div>
                </div>
                <div class="my-3">
                    <div id="outcome-scenario-detail"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>{{ $head_title }} Data</h5>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="footer-search" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>Scenario ID</th>
                            <th>Scenario Name</th>
                            <th>Variable ID</th>
                            <th>Variable Name</th>
                            <th>Node Point</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scenarioData as $data)
                            <tr>
                                <td>{{ $data->scenario_id }}</td>
                                <td>{{ $data->scenario->name }}</td>
                                <td>{{ $data->variable_id }}</td>
                                <td>{{ $data->variable->name }}</td>
                                <td>{{ $data->node_point }}</td>
                                <td>{{ $data->value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Scenario ID</th>
                            <th>Scenario Name</th>
                            <th>Variable ID</th>
                            <th>Variable Name</th>
                            <th>Node Point</th>
                            <th>Value</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
<script src="<?= asset('assets/js/pages/menu/simulation.js') ?>"></script>
<script>
    $(document).ready(function () {
        $('#footer-search').DataTable();
    });

</script>
@endsection
