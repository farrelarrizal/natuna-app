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
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div>
                        <hr>
                        <br>
                        <h4>Severity</h4>
                    </div>
                    <!-- drop down -->
                    <div class="mb-3">
                        <label for="severity" class="form-label">Defence Severity</label>
                        <select class="form-select" id="severity" name="severity" required>
                            <option value="LOW">Low</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="HIGH">High</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="severity" class="form-label">Infrastructure Defence Severity</label>
                        <select class="form-select" id="severity" name="severity" required>
                            <option value="LOW">Low</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="HIGH">High</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="severity" class="form-label">Marine Resource</label>
                        <select class="form-select" id="severity" name="severity" required>
                            <option value="LOW">Low</option>
                            <option value="MEDIUM">Medium</option>
                            <option value="HIGH">High</option>
                        </select>
                    </div>
                    
                    <!-- ck editor -->
                    <br>
                    <span>
                        <hr>
                        <h4>Expert Recommendation</h4>
                    </span>
                    <div class="mb-3">
                        <label for="action" class="form-label">Analisa Kondisi</label>
                        <textarea name="condition" id="condition">
                            <h2>How to use this recommendation</h2>
                            <p>1. Do this</p>
                            <p>2. Do that</p>
                            <p>3. Do this and that</p>
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="action" class="form-label">Rekomendasi</label>
                        <textarea name="recommendation" id="recommendation">
                            <h2>How to use this recommendation</h2>
                            <p>1. Do this</p>
                            <p>2. Do that</p>
                            <p>3. Do this and that</p>
                        </textarea>
                    </div>
                    <br>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Perjalanan Skenario</label>
                    <div class="col-sm-10 col-form-label">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" id="perjalananskenario1">
                            <label class="form-check-label" for="perjalananskenario1">Peningkatan Kemampuan Kapal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="2" id="perjalananskenario2">
                            <label class="form-check-label" for="perjalananskenario2">Kerjasama Bilateral</label>
                        </div>
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
      ClassicEditor.create(document.querySelector('#recommendation')).catch((error) => {
        console.error(error);
      });
    })();

    (function () {
      ClassicEditor.create(document.querySelector('#condition')).catch((error) => {
        console.error(error);
      });
    })();
  </script>
<!-- [Page Specific JS] end -->
@endsection