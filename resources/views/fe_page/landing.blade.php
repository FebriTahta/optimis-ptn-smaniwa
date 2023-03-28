@extends('fe_layouts.master')

@section('content')
<div class="bg_gray">
    <div class="container margin_60_40">
        <div class="main_title center add_bottom_10">
            <span><em></em></span>
            <h2>Ooptimis PTN</h2>
            <p>Berikut langkah untuk memilih PTN anda</p>
        </div>
        <div class="row justify-content-md-center how_2">
            <div class="col-lg-5 text-center">
                <figure>
                    <img src="{{ asset('fe_assets/img/web_wireframe.svg') }}" data-src="img/web_wireframe.svg" alt="" class="img-fluid lazy loaded" width="360" height="380" data-was-processed="true">
                </figure>
            </div>
            <div class="col-lg-5">
                <ul>
                    <li>
                        <h3><span>#01.</span> Login Sistem</h3>
                        <p>Masuk dengan akun siswa yang yang dimiliki</p>
                    </li>
                    <li>
                        <h3><span>#02.</span> Periksa kelengkapan form</h3>
                        <p>Masukan informasi yang diminta terkait dengan hasil ujian yang diterima</p>
                    </li>
                    <li>
                        <h3><span>#03.</span> Pilih PTN</h3>
                        <p>Pilih PTN yang diminati dan lihat kalkulasi hasil kemungkinan lolos</p>
                    </li>
                </ul>
                <p class="add_top_30"><a href="/login" class="btn_1">Login & Pilih PTN</a>
                    <a href="#" class="btn_1">Website Smaniwa ?</a></p>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /container -->
</div></div>
@endsection