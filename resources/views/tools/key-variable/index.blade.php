@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>" >
@endsection

@section('content')
@include('partials/breadcrumb')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Key Variables</h5>
            
          </div>
          <div class="card-body">
            <div class="dt-responsive table-responsive">
              <table id="footer-search" class="table table-striped table-bordered nowrap">
                <tr>
                    <th>Model ID</th>
                    <th>Name</th>
                    <th>Key Variable</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($variables as $variable)
                <tr>
                    <td>{{ $variable->model_id }}</td>
                    <td>{{ $variable->name }}</td>
                    <td>{{ $variable->key_variable ? 'Yes' : 'No' }}</td>
                    <td>
                        
                            <a class="btn btn-info" href="{{ route('tools.key-variable.edit', $variable->id) }}">Edit</a>
                        
                    </td>
                </tr>
                @endforeach
            </table>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection