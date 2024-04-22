<!DOCTYPE html>
<html lang="en">

<head>

    @include('partials/head-page-meta')
    @include('partials/head-css')

</head>
<body>
    @include('partials/loader')
    <div class="maintenance-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card error-card">
                        <div class="card-body">
                            <div class="error-image-block">
                                <div class="row justify-content-center">
                                    <div class="col-10">
                                        <img class="img-fluid" src="<?= asset('assets/images/pages/img-error-500.svg') ?>" alt="img">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h1 class="mt-4"><b>Internal Server Error</b></h1>
                                <p class="mt-2 mb-4 text-sm text-muted">Server error 500. we fixing the problem. please<br> try again at a later
                                    stage.</p>
                                <button type="button" class="btn btn-primary mb-3">Go to homepage</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials/footer-js')
    @include('partials/customizer')
</body>
<!-- [Body] end -->
</html>
