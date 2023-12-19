@extends('landing.layouts.master')


@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('build/assets/landing') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Daftar Mobil <i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Pilih Mobil Anda</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            @foreach($cars as $car)
            <div class="col-md-4">
                <div class="car-wrap rounded ftco-animate">
                    <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('cars') }}/{{ $car->images[0]->url }}');">
                    </div>
                    <div class="text">
                        <h2 class="mb-0"><a href="car-single.html">{{ $car->name }} <small>({{ $car->launch_year }})</small></a></h2>
                        <div class="d-flex mb-3">
                            <span class="cat">{{ $car->brand->name }}</span>
                            <p class="price ml-auto">{{ number_format($car->price_per_day, 0) }} <span>/hari</span></p>
                        </div>

                        @if(count($rentedCars) > 0)
                        @foreach($rentedCars as $j => $rCar)
                        @if($car->id == $rCar->car_id)
                        <p class="d-flex mb-0 d-block"><span class="btn btn-danger py-2 mr-1">Sedang Rental</span> <small>Tersedia pada: <br> {{ date('d M Y', strtotime($rCar->end_date)) }} - {{ date('H:i', strtotime($rCar->pickup_time)) }}</small></p>
                        @break
                        @else
                        <p class="d-flex mb-0 d-block"><a href="{{ route('car-detail', $car->id) }}" class="btn btn-primary py-2 mr-1">Sewa Sekarang</a> </p>
                        @endif
                        @endforeach
                        @else
                        <p class="d-flex mb-0 d-block"><a href="{{ route('car-detail', $car->id) }}" class="btn btn-primary py-2 mr-1">Sewa Sekarang</a> </p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <li><a href="{{ $cars->onFirstPage() ? 'javascript:void(0)' : $cars->previousPageUrl() }}" class="{{ $cars->onFirstPage() ? 'text-secondary': '' }}">&lt;</a></li>
                        <li><a href="{{ $cars->hasMorePages() ? $cars->nextPageUrl() : 'javascript:void(0)' }}" class="{{ $cars->hasMorePages() ? '': 'text-secondary' }}">&gt;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection