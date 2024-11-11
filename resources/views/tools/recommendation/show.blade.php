@extends('layouts.app')

@section('content')
@include('partials/breadcrumb')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <!-- table -->
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Recommendation Name</th>
                            <td>Survey Naval Sea Threats</td>
                        </tr>
                        <tr>
                            <th>Severity</th>
                            <td>
                                <span class="btn btn-sm btn-light-danger">Low</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Related Variable</th>
                            <td>Naval Sea Threats</td>
                        </tr>
                        <tr>
                            <th>Expert Recommendation</th>
                            <td>
                                <h2>How to use this recommendation</h2>
                                <p>1. Do this</p>
                                <p>2. Do that</p>
                                <p>3. Do this and that</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- edit button -->
                <div>
                    <a href="{{ route('tools.recommendation.index') }}" class="btn btn-light-secondary">Back</a>
                    <a href="{{ route('tools.recommendation.edit', 1) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
<!-- [Page Specific JS] start -->
  <!-- Ckeditor js -->
  <script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
  <script>
    (function () {
      ClassicEditor.create(document.querySelector('#classic-editor')).catch((error) => {
        console.error(error);
      });
    })();
  </script>
<!-- [Page Specific JS] end -->
@endsection