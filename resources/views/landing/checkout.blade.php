@extends('landing.layouts.master')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('build/assets/landing') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Detail Mobil<i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Detail Checkout</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12">
                <div class="row mb-5">
                    <div class="col-md-12">

                        <a href="{{ route('home') }}">Kembali ke home</a>

                        <div class="border w-100 p-4 rounded mb-2 d-flex">
                            <div class="icon mr-3">
                                <span class="icon-map-o mt-2"></span>
                            </div>
                            <p><span>Detail Pemesanan:</span> Nomor : {{ $order->order_number }} <br> {{ $order->user->fullname }} </p>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Mobil</th>
                                    <th class="text-center">Tanggal Mulai</th>
                                    <th class="text-center">Tanggal Selesai</th>
                                    <th class="text-center">Waktu Pengambilan</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="img text-center">
                                            <img src="{{ asset('cars') }}/{{ $order->car->images[0]->url }}" width="120">
                                        </div>
                                    </td>
                                    <td>{{ $order->car->name }}
                                        <br>
                                        <small>{{ $order->car->brand->name }}</small>
                                    </td>
                                    <td class="text-center">{{ date('d, M Y', strtotime($order->start_date)) }}</td>
                                    <td class="text-center">{{ date('d, M Y', strtotime($order->end_date)) }}</td>
                                    <td class="text-center">{{ $order->pickup_time }}</td>
                                    <td class="text-center">{{ $order->order_status }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi Penjemputan</th>
                                    <td colspan="5">{{ $order->pickup_location ? $order->pickup_location : 'Tempat Rental' }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi Pengembalian</th>
                                    <td colspan="5">{{ $order->dropoff_location ? $order->dropoff_location : 'Tempat Rental' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="border w-100 p-4 rounded mb-2 d-flex">
                            <div class="icon mr-3">
                                <span class="icon-money"></span>
                            </div>
                            <p>
                                <span>Pembayaran:</span>
                                {{ $order->payment->payment_method->name }} <small class="text-primary">[{{ $order->payment->payment_status }}]</small>
                                <br> Total: Rp.{{ number_format($order->payment->grand_total, 0) }}
                            </p>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Jenis</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->payment->actions as $action)

                                @if($action->name == 'generate-qr-code')
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>Scan QR</td>
                                    <td class="text-center"><a href="{{ $action->url }}" target="_blank"><img src="{{ route('get-image', ['url' => $action->url]) }}" alt="Image" width="200" height="200"></a></td>
                                </tr>
                                @elseif($action->name == 'deeplink-redirect')
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>Website</td>
                                    <td><a class="btn btn-primary" href="{{ $action->url }}" target="_blank">Bayar</a></td>
                                </tr>
                                @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="map" class="bg-white"></div>
            </div>
        </div>
    </div>
</section>
@endsection