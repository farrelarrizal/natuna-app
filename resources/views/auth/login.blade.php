<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>

    @include('partials/head-page-meta')
    @include('partials/head-css')

</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body>
@include('partials/loader')
    <!-- [ Main Content ] start -->
<div class="auth-main">
    <div class="auth-wrapper v2">
        {{-- <div class="auth-sidecontent">
            <img src="<?= asset('assets/landing/img/logo/logo mina.png') ?>" alt="images" height="100px" width="100px"
                 class="img-fluid img-auth-side">
        </div> --}}
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <img src="assets/landing/img/logo/logo mina.png" alt="" srcset="" width="100%" height="100%">
                    <div class="text-center">
                    <br>
                    <h4 class="text-center f-w-500 mb-3">Login As Admin</h4>
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" id="floatingInput1" placeholder="Password" name="password">
                            </div>
                            <div class="d-flex mt-1 justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input input-danger" type="checkbox" id="customCheckc1" checked="">
                                    <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                                </div>
                                <h6 class="text-secondary f-w-400 mb-0">Forgot Password?</h6>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-danger">Login</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@include('partials/footer-js')
@include('partials/customizer')
</body>
<!-- [Body] end -->
</html>
