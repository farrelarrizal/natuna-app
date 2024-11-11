@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Rekomendasi Kebijakan</h5>
                </div>
                <div class="card-body">
                    <p>Rekomendasi kebijakan berdasarkan permasalahan yang diangkat adalah sebagai berikut:</p>
                    <ul>
                        <li>Penegakan hukum internasional</li>
                        <li>Diplomasi multilateral</li>
                        <li>Peningkatan kapabilitas maritim</li>
                        <li>Kerjasama aliansi</li>
                        <li>Pendekatan ekonomi</li>
                    </ul>

                    <h5>Rekomendasi 1: Penegakan Hukum Internasional</h5>
                    <p>Indonesia perlu menekankan pentingnya menegakkan hukum internasional, termasuk Konvensi PBB tentang Hukum Laut (UNCLOS), sebagai dasar penyelesaian sengketa di Laut China Selatan. Penegakan hukum internasional akan membantu memastikan bahwa semua klaim teritorial dievaluasi dan diselesaikan secara adil. Indonesia harus bekerja sama dengan negara-negara ASEAN dan komunitas internasional untuk mendorong kepatuhan terhadap UNCLOS.</p>

                    <h5>Rekomendasi 2: Diplomasi Multilateral</h5>
                    <p>Mendorong dialog damai dan kerjasama multilateral di antara negara-negara pengklaim untuk mencegah peningkatan ketegangan. Indonesia dapat memfasilitasi pertemuan dan negosiasi antara negara-negara yang terlibat dalam sengketa, dengan tujuan mencapai kesepakatan yang saling menguntungkan. Diplomasi multilateral yang efektif akan membantu membangun kepercayaan dan menciptakan lingkungan yang kondusif bagi perdamaian.</p>

                    <h5>Rekomendasi 3: Peningkatan Kapabilitas Maritim</h5>
                    <p>Mengembangkan kemampuan militer dan maritim untuk menegaskan kehadiran di Laut China Selatan sambil menghindari konfrontasi langsung. Indonesia perlu meningkatkan investasi dalam teknologi maritim dan pertahanan untuk memperkuat kemampuan pengawasan dan penegakan hukum di perairan sengketa. Latihan bersama dengan negara-negara tetangga dan patroli maritim dapat membantu memperkuat keamanan dan stabilitas di kawasan.</p>

                    <h5>Rekomendasi 4: Kerjasama Aliansi</h5>
                    <p>Meningkatkan kerjasama dengan aliansi internasional yang mendukung penegakan hukum dan keamanan regional. Indonesia dapat memperkuat hubungannya dengan negara-negara seperti Amerika Serikat, Jepang, India, dan Australia untuk membangun aliansi strategis yang dapat mengimbangi pengaruh militer Tiongkok. Kerjasama ini harus mencakup latihan militer bersama, pertukaran intelijen, dan dukungan logistik.</p>

                    <h5>Rekomendasi 5: Pendekatan Ekonomi Bijaksana</h5>
                    <p>Mengambil pendekatan yang bijaksana dan moderat dalam kerjasama ekonomi dengan Tiongkok, sambil menjaga kedaulatan nasional. Indonesia harus menyeimbangkan antara kepentingan ekonomi dan keamanan nasional dalam hubungannya dengan Tiongkok. Diversifikasi mitra dagang dan investasi dapat membantu mengurangi ketergantungan ekonomi pada Tiongkok dan memperkuat posisi Indonesia dalam negosiasi terkait sengketa teritorial.</p>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection