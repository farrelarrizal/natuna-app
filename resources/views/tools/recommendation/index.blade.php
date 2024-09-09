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
                        <th class="">Classification <br>Severity</th>
                        <th class="">Defence <br>Severity</th>
                        <th class="">Defence <br>Infra Severity</th>
                        <th class="">Marine <br>Resource</th>
                        <th class="">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <span class="btn btn-sm btn-light-danger">Low</span>
                            </td>
                            <td>
                              <span class="btn btn-sm btn-light-danger">Low</span>
                            </td>
                            <td>
                              <span class="btn btn-sm btn-light-danger">Low</span>
                            </td>
                            <td>
                              <span class="btn btn-sm btn-light-danger">Low</span>
                          </td>
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
                          <th class="">Classification <br>Severity</th>
                          <th class="">Defence <br>Severity</th>
                          <th class="">Defence <br>Infra Severity</th>
                          <th class="">Marine <br>Resource</th>
                          <th class="">Action</th>
                          </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection

