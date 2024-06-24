@extends('layouts.landing')
@section('content')
<!-- Slider Area Start-->
<div class="services-area">
    <div class="container">
        <!-- Section-tittle -->
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="section-tittle text-center mb-80">
                    <span>Artikel</span>
                    <h2>Artikel Mina Wisata​</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Slider Area End-->

<!--================Blog Area =================-->
<section class="blog_area section-paddingr">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    @foreach ($articles as $article)
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="{{ asset($article->image) }}" alt="Gambar Artikel">
                            <a href="artikel_detail.html" class="blog_item_date">
                                <h3>{{ $article->day }}</h3>
                                <p>{{ $article->month }}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="{{ route('articles.show', $article->url) }}">
                                <h2>{{ $article->title }}</h2>
                                
                            </a>
                            @if(strlen($article->desc) > 250)
                                <p>{{ substr($article->desc, 0, 255) }}...</p>
                            @else
                                <p>{{ $article->desc }}</p>
                            @endif
                            
                            <ul class="blog-info-link">
                                <div class="do-btn">
                                    <a href="{{ route('articles.show', $article->url) }}"><i class="ti-arrow-right"></i> Lanjutkan Membaca</a>
                                </div>
                            </ul>
                        </div>
                    @endforeach
                    {{-- <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="assets/landing/img/tips/ibadah di muharram.jpg" alt="">
                            <a href="artikel_detail.html" class="blog_item_date">
                                <h3>24</h3>
                                <p>Aug</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="single-blog.html">
                                <h2>Amal Ibadah Di Bulan Muharram</h2>
                            </a>
                            <p>Saudaraku, ada banyak amal ibadah yang dianjurkan diamalkan di bulan pertama tahun Hijriyah sekarang ini. 
                                Beberapa amal ibadah itu memiliki pahala yang luar biasa besarnya. 
                                Berikut tiga amal penting yang harus dilaksanakan umat Islam di bulan Muharram ini.
                            </p>
                            <ul class="blog-info-link">
                                <div class="do-btn">
                                    <a href="artikel_detail.html"><i class="ti-arrow-right"></i> Lanjutkan Membaca</a>
                                </div>
                            </ul>
                        </div>
                    </article>

                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="assets/landing/img/tips/Umrah sesuai sunnah rasul.jpg" alt="">
                            <a href="#" class="blog_item_date">
                                <h3>10</h3>
                                <p>May</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="single-blog.html">
                                <h2>Tata Cara Umroh Sesuai Sunnah Beserta Larangannya</h2>
                            </a>
                            <p>Tata Cara Umroh Sesuai Sunnah Beserta Larangannya – Tata Cara umroh lengkap sesuai Sunnah Nabi Muhammad SAW. 
                                Menurut kamus besar bahasa Indonesia umrah adalah kunjungan (ziarah) ke tempat suci (sebagai bagian dari rukun haji, 
                                dilakukan setiba di Mekah) dengan cara berihram, tawaf, sai dan bercukur, tanpa wukuf dipadang Arafah, 
                                yang waktu menunaikannya dapat bersamaan dengan waktu haji. Umrah juga biasa disebut dengan haji kecil.</p>
                                <ul class="blog-info-link">
                                    <div class="do-btn">
                                        <a href="#"><i class="ti-arrow-right"></i> Lanjutkan Membaca</a>
                                    </div>
                                </ul>
                        </div>
                    </article>

                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="assets/landing/img/tips/puasa dengan cara rasul.jpg" alt="">
                            <a href="#" class="blog_item_date">
                                <h3>10</h3>
                                <p>May</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="single-blog.html">
                                <h2>Tata Cara Berpuasa yang Benar Sesuai Petunjuk Rasulullah SAW</h2>
                            </a>
                            <p>Nabi SAW merupakan Nabi yang diutus oleh Allah SWT sebagai nabi terakhir yang menjadi petunjuk jalan kebenaran kepada umat manusia. Segala yang dilakukan dan disabdakan Rasulullah SAW adalah benar dan menjadi amalan sunnah bagi yang menjalankannya. Dalam hal ini, akan kita bahas mengenai tata cara berpuasa sesuai dengan petunjuk Rasulullah SAW.</p>
                            <ul class="blog-info-link">
                                <div class="do-btn">
                                    <a href="#"><i class="ti-arrow-right"></i> Lanjutkan Membaca</a>
                                </div>
                            </ul>
                        </div>
                    </article>

                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="assets/landing/img/tips/ingatlah Allah.jpg" alt="">
                            <a href="#" class="blog_item_date">
                                <h3>15</h3>
                                <p>Jan</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="single-blog.html">
                                <h2>Ingatlah Allah, Kita akan Diingat Allah</h2>
                            </a>
                            <p>Saudaraku, kalau dalam hidup ini semua aktifitas kita tidak lepas dari aturan Allah dan semata mata dilakukan karena itu perintah Allah maka Insha Allah hidup kita senantiasa dalam lindungan dan naungan Allah. Istilah Allah dalam Alquran, "maka ingatlah kepadaKu, Aku akan ingat kepadamu".</p>
                            <ul class="blog-info-link">
                                <div class="do-btn">
                                    <a href="#"><i class="ti-arrow-right"></i> Lanjutkan Membaca</a>
                                </div>
                            </ul>
                        </div>
                    </article>

                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="assets/landing/img/tips/museum haramain.jpg" alt="">
                            <a href="#" class="blog_item_date">
                                <h3>15</h3>
                                <p>Jan</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="single-blog.html">
                                <h2>Niat dan Tata cara sholat tarawih</h2>
                            </a>
                            <p>Sholat tarawih adalah ibadah sholat sunnah yang dilakukan setelah menjalankan sholat Isya pada bulan Ramadan. Ibadah ini bisa dilakukan sendirian atau berjemaah.</p>
                            <ul class="blog-info-link">
                                <div class="do-btn">
                                    <a href="#"><i class="ti-arrow-right"></i> Lanjutkan Membaca</a>
                                </div>
                            </ul>
                        </div>
                    </article>
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="assets/landing/img/tips/sedekah.jpg" alt="">
                            <a href="#" class="blog_item_date">
                                <h3>15</h3>
                                <p>Jan</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="single-blog.html">
                                <h2>Sedekah Jangan Menunggu Sakit</h2>
                            </a>
                            <p>Saudaraku, dalam sebuah hadis disebutkan bahwa Rasulullah bersabda "Sembuhkan sakitmu dengan sedekah."
                                 Itu artinya, meski tidak ada hubungan secara medis, sesungguhnya karena kasih sayang dan kehendak Allah maka sedekah itu mampu sebagai salah satu ikhtiar untuk menyembuhkan sakit. Dan itu banyak yang sudah merasakan dan membuktikannya.</p>
                                 <ul class="blog-info-link">
                                    <div class="do-btn">
                                        <a href="#"><i class="ti-arrow-right"></i> Lanjutkan Membaca</a>
                                    </div>
                                </ul>
                        </div>
                    </article> --}}
                </div>
            </div>
             <!-- Start Konten samping kanan -->
        <div class="col-lg-4">
            <div class="blog_right_sidebar">
               <aside class="single_sidebar_widget post_category_widget">
                  <h4 class="widget_title">Kategori Paket</h4>
                  <ul class="list cat-list">
                     <li>
                        <a href="#" class="d-flex">
                           <p>Umrah Reguler</p>
                        </a>
                     </li>
                     <li>
                        <a href="#" class="d-flex">
                           <p>Haji Plus</p>
                        </a>
                     </li>
                     <li>
                        <a href="#" class="d-flex">
                           <p>Umrah Hemat</p>
                        </a>
                     </li>
                     <li>
                        <a href="#" class="d-flex">
                           <p>Umrah & Tour</p>
                        </a>
                     </li>
                  </ul>
               </aside>
               <aside class="single_sidebar_widget popular_post_widget">
                  <h3 class="widget_title">Paket Paling laris</h3>
                  @foreach ($favorite_packages as $package)
                    <div class="media post_item">
                        <img src="{{ asset($package->media_banner) }}" alt="{{ $package->package_name }} width="100" height="100">
                        <div class="media-body
                        ">
                            <a href="{{ route('package.show', $package->id) }}">
                                <h3>{{ $package->package_name }}</h3>
                            </a>
                            <p>Mulai dari {{ $package->harga_mulai }} Jutaan</p>
                        </div>
                    </div>
                    @endforeach
               </aside>
               
               <aside class="single_sidebar_widget tag_cloud_widget">
                 <h4 class="widget_title">Informasi Kontak</h4>
                 <div class="media contact-info">
                   <span class="contact-info__icon"><i class="ti-home"></i></span>
                   <div class="media-body">
                       <h3>Jl Raya RA Kartini No. 123 E Surabaya 60246. </h3>
                       <p>Surabaya, Jawa Timur</p>
                   </div>
               </div>
               <div class="media contact-info">
                   <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                   <div class="media-body">
                       <h3>+6281 357 852 189</h3>
                       <p>Hubungi WhatsApp</p>
                   </div>
               </div>
               <div class="media contact-info">
                   <span class="contact-info__icon"><i class="ti-email"></i></span>
                   <div class="media-body">
                       <h3>mariumrah@minawisata.com</h3>
                       <p>Alamat E-mail</p>
                   </div>
               </div>
               <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                        type="download">Download Katalog</button>
            </div>
         </div>
         <!-- end konten samping kanan -->
      </div>
   </div>
</section>
<!--================ Blog Area end =================-->
@endsection