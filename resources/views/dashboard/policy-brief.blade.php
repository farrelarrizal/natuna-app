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
                <h5>Policy Brief</h5>
            </div>
            <div class="card-body">

                <!-- put image on the center of page put caption on the image -->
                <div class="text-center">
                    <img src="https://onecms-res.cloudinary.com/image/upload/s--v9dF0kmj--/f_auto,q_auto/v1/mediacorp/cna/image/2023/08/04/20230727-Natuna-Islands.png?itok=btL6CFLp" alt="policy-brief" class="img-fluid">
                    <p class="text-center">Peta Konflik Laut China Selatan</p>
                </div>
                <br>
                
                <h5>Deskripsi Masalah 1</h5>
                <p>Klaim historis Tiongkok atas wilayah Laut China Selatan, yang berjarak lebih dari 1.000 kilometer dari pantainya, menyebabkan posisi yang mengakar dan keengganan untuk berkompromi.</p>
                
                <h5>Deskripsi Masalah 2</h5>
                <p>Ketegangan Ekonomi: Sengketa maritim yang berkepanjangan dan belum terselesaikan dengan Tiongkok mengancam stabilitas ekonomi dan keamanan perbatasan Indonesia.</p>
            
                <h5>Deskripsi Masalah 3</h5>
                <p>Kekuatan militer Tiongkok yang terus meningkat membatasi pilihan negara-negara tetangga untuk membangun kapabilitas militer yang seimbang. Peningkatan kemampuan militer Tiongkok, termasuk pembangunan infrastruktur militer di pulau-pulau yang disengketakan, menimbulkan ancaman bagi keamanan regional. Negara-negara tetangga, termasuk Indonesia, menghadapi tantangan besar dalam menandingi sumber daya dan potensi militer Tiongkok.</p>
                
                <h5>Deskripsi masalah 4</h5>
                <p>Aliansi Internasional. Ketidaksempurnaan aturan hukum internasional dan UNCLOS, serta keterlibatan aliansi terbuka negara-negara penegak hukum, menjadi tantangan dalam mewujudkan keamanan regional. Aliansi internasional seperti Amerika Serikat, Jepang, India, dan Australia memiliki kepentingan strategis dalam menjaga kebebasan navigasi di Laut China Selatan. Namun, ketidaksempurnaan hukum internasional sering kali menyulitkan implementasi resolusi yang adil dan damai.</p>
                
                <h5>Deskripsi masalah 5</h5>
                <p>Diplomasi yang lemah. Kurangnya pendekatan diplomasi yang konsisten dan efektif oleh negara-negara ASEAN dalam menghadapi Tiongkok. ASEAN perlu memainkan peran yang lebih proaktif dalam menyelesaikan sengketa teritorial dan mengurangi ketegangan regional. Diplomasi yang lemah dapat memperburuk situasi dan menghambat upaya untuk mencapai perdamaian dan stabilitas di kawasan.</p>
            
            
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection