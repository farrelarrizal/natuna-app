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
        <div class="auth-sidecontent">
        </div>
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('/assets/images/logo-dasina.png')}}" alt="" style="width:10em">
                    <h5 class="text-center f-w-500 mb-3">Login with your email</h5>
                    <br>
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="Email Address" name="email">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" id="floatingInput1" placeholder="Password" name="password">
                            </div>
                            <div class="d-flex mt-1 justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input input-warning" type="checkbox" id="customCheckc1" checked="">
                                    <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                                </div>
                                <h6 class="text-secondary f-w-400 mb-0">Forgot Password?</h6>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-warning">Login</button>
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
