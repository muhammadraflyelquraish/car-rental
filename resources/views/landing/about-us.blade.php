@extends('landing.layouts.master')

@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('build/assets/landing') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Tetang Kami <i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Tentang Kami</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-about">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('build/assets/landing') }}/images/about.jpg');">
            </div>
            <div class="col-md-6 wrap-about ftco-animate">
                <div class="heading-section heading-section-white pl-md-5">
                    <span class="subheading">Tentang Kami</span>
                    <h2 class="mb-4">Selamat Datang di Carbook</h2>
                    <p>
                        Kami menyediakan solusi transportasi yang nyaman dan handal bagi perjalanan Anda. Dengan berbagai pilihan mobil berkualitas terbaik, kami menghadirkan pengalaman menyewa mobil yang tak terlupakan.
                    </p>
                    <p>
                        Tidak peduli apakah Anda dalam perjalanan bisnis, liburan keluarga, atau perjalanan solo, kami berkomitmen untuk memberikan mobil yang tepat dan layanan yang tak tertandingi.
                    </p>
                    <p>
                        Jangan ragu untuk menjelajahi koleksi mobil kami dan memesan secara online melalui website kami. Terima kasih telah memilih kami sebagai partner perjalanan Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection