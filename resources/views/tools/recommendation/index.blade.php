@extends('layouts.app')

@section('content')
    @include('partials/breadcrumb')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!-- add on right -->
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('tools.recommendation.create') }}" class="btn btn-sm btn-light-primary">
                        <i class="fas fa-plus"></i>
                        Add Recommendation</a>
                </div>

              <div class="card-body">
                <div class="dt-responsive table-responsive">
                  <table id="footer-search" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th class="col-1">No</th>
                        <th>Recommendation Name</th>
                        <th>Severity</th>
                        <th>Related Variable</th>
                        <th class="col-1">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Survey Naval Sea Threats</td>
                            <td>
                                <span class="btn btn-sm btn-light-danger">Low</span>
                            </td>
                            <td>Naval Sea Threats</td>
                            <td>
                                <!-- isi survey -->
                                <a href="{{route('tools.recommendation.edit', 1)}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit </a>
                                <a href="{{route('tools.recommendation.show', 1)}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> View </a>
                                <a href="{{route('tools.recommendation.delete', 1)}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete </a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="col-1">No</th>
                            <th>Recommendation Name</th>
                            <th>Severity</th>
                            <th>Related Variable</th>
                            <th class="col-1">Action</th>
                          </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection

