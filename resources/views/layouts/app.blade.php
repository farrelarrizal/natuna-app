<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>
    @include('partials/head-page-meta')
    @include('partials/head-css')
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
<script src="<?= asset('assets/js/pages/dashboard-default.js') ?>"></script>
<!-- [Page Specific JS] end -->
@include('partials/customizer')
@yield('script')

</body>
<!-- [Body] end -->
</html>
