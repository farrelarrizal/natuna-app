@extends('layouts.app')

@section('content')
@include('partials/breadcrumb')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                

              <div class="card-body">
                <!-- form -->
                <form action="{{ route('tools.recommendation.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Recommendation Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <!-- drop down -->
                    <div class="mb-3">
                        <label for="severity" class="form-label">Severity</label>
                        <select class="form-select" id="severity" name="severity" required>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="related_variable" class="form-label">Related Variable</label>
                        <input type="text" class="form-control" id="related_variable" name="related_variable" required>
                    </div>
                    <!-- ck editor -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="action" class="form-label">Expert Recommendation</label>
                        <textarea name="content" id="classic-editor">
                            <h2>How to use this recommendation</h2>
                            <p>1. Do this</p>
                            <p>2. Do that</p>
                            <p>3. Do this and that</p>
                        </textarea>
                    </div>
                    <div>
                        <a href="{{ route('tools.recommendation.index') }}" class="btn btn-light-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
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