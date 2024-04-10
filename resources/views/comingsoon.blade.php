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
    <div class="maintenance-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card soon-card">
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-6">
                                    <img class="img-fluid" src="<?= asset('assets/images/ramadhan.png') ?>" alt="img" />
                                </div>
                                <div class="col-md-4">
                                    <h2 class="text-center">Selamat Idul Fitri 1445 H</h2>
                                    <h3 class="text-center">Mohon Maaf Lahir dan Batin</h3>
                                    <h4 class="mt-4 text-center f-24"><b>ABMAS Coming Soon</b></h4>
                                    <p class="mt-3 mb-0 text-center text-muted f-16">Something new is on it's way</p>
                                    <p class="mt-0 mb-4 text-center text-muted f-16">In <strong>Samil and Dito</strong> We Trust!</p>
                                    <div class="row timer-block mt-4 justify-content-center" id="timer-block">
                                        <div class="col-auto">
                                            <span class="avtar avtar-xl">..</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="avtar avtar-xl">..</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="avtar avtar-xl">..</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="avtar avtar-xl">..</span>
                                        </div>
                                    </div>

                                    <a href="https://link.dana.id/kaget?c=s3yryu5ea&r=gsUb9K" class="text-center btn btn-primary text-center col-md-12 mt-3">Save Your Dana THR!</a>
                                </div>
                                <p class="text-center">Made with 🫶🏻 Farrel Arrizal </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('partials/footer-js')
    @include('partials/customizer')

    <script>
        var d = new Date();
        // set 1 may 2024
        d.setFullYear(2024, 6, 1);
        // d.setDate(d.getDate() + 2);
        var countDownDate = new Date(d).getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById('timer-block').innerHTML =
                '<div class="col-auto"><span class="avtar  avtar-xl">' +
                days +
                '<br><small>days</small></span></div><div class="col-auto"><span class="avtar  avtar-xl">' +
                hours +
                '<br><small>hours</small></span></div><div class="col-auto"><span class="avtar  avtar-xl">' +
                minutes +
                '<br><small>min</small></span></div><div class="col-auto"><span class="avtar  avtar-xl">' +
                seconds +
                '<br><small>sec</small></span></div>';
            if (distance < 0) {
                clearInterval(x);
                document.getElementById('timer-block').innerHTML = 'Times over';
            }
        }, 1000);
    </script>
</body>
<!-- [Body] end -->

</html>