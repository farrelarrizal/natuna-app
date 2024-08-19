<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>
    @include('partials/head-page-meta')
    @include('partials/head-css')
    @yield('css')
    <style>
        .pc-link.active .pc-micon path {
            fill: #4680FF;
        }
    </style>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body >
@include('partials/loader')
@include('partials/sidebar')
@include('partials/topbar')
    <!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
            <!-- [ Main Content ] start -->
            @yield('content')
            <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
@include('partials/footer-block')
@include('partials/footer-js')
    <!-- [Page Specific JS] start-->
<!-- Apex Chart -->
<script src="<?= asset('assets/js/plugins/apexcharts.min.js') ?>"></script>
<!-- Sweet Alert -->
<script src="<?= asset('assets/js/plugins/sweetalert2.all.min.js') ?>"></script>
<script src="<?= asset('assets/js/pages/ac-alert.js') ?>"></script>
<!-- [Page Specific JS] end -->
@include('partials/customizer')
@yield('script')

</body>
<!-- [Body] end -->
</html>
