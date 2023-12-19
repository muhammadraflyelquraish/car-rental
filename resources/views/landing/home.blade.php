@extends('landing.layouts.master')

@section('content')

<div class="hero-wrap ftco-degree-bg" style="background-image: url('{{ asset('build/assets/landing') }}/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
            <div class="col-lg-8 ftco-animate">
                <div class="text w-100 text-center mb-md-5 pb-md-5">
                    <h1 class="mb-4">Cepat &amp; Mudah Sewa Mobil</h1>
                    <p style="font-size: 18px;">Temukan Kenyamanan yang Sempurna: Carbook hadir senantiasa berusaha memenuhi kebutuhan anda.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-12 featured-top">
                <div class="row no-gutters">

                    @if(auth()->user())

                    @if($activeOrder)
                    <div class="col-md-12 d-flex align-items-center">
                        <div class="services-wrap rounded-right w-100">
                            <h2 class="heading-section mb-2">Hai, {{ auth()->user()->fullname }}</h2>
                            <span class="mb-4">Informasi Rental</span>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Mobil</th>
                                        <th class="text-center">Tanggal Mulai</th>
                                        <th class="text-center">Tanggal Selesai</th>
                                        <th class="text-center">Waktu</th>
                                        <th class="text-center">Status</th>
                                        <td class="text-center"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="img text-center">
                                                <img src="{{ asset('cars') }}/{{ $activeOrder->car->images[0]->url }}" width="120">
                                            </div>
                                        </td>
                                        <td>{{ $activeOrder->car->name }}
                                            <br>
                                            <small>{{ $activeOrder->car->brand->name }}</small>
                                        </td>
                                        <td class="text-center">{{ date('d, M Y', strtotime($activeOrder->start_date)) }}</td>
                                        <td class="text-center">{{ date('d, M Y', strtotime($activeOrder->end_date)) }}</td>
                                        <td class="text-center">{{ $activeOrder->pickup_time }}</td>
                                        <td class="text-center">{{ $activeOrder->order_status }}</td>
                                        <td class="text-center">
                                            @if($activeOrder->order_status == 'Waiting For Payment')

                                            <a class="btn btn-primary btn-sm" href="{{ route('checkout.show', $activeOrder->id) }}">Detail</a> <br>

                                            @foreach($activeOrder->payment->actions as $action)
                                            @if($action->name == 'cancel')
                                            <button class="btn btn-danger btn-sm mt-2" id="cancelOrder" data-url="{{ route('checkout.cancel', ['url' => $action->url, 'orderId' => $activeOrder->id]) }}">Batalkan</button>
                                            @break
                                            @endif

                                            @if($loop->last)
                                            <button class="btn btn-danger btn-sm mt-2" id="cancelOrder" data-url="{{ route('checkout.cancel', ['orderId' => $activeOrder->id]) }}">Batalkan</button>
                                            @endif
                                            @endforeach

                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="col-md-4 d-flex align-items-center">
                        <form action="#" class="request-form ftco-animate bg-primary">
                            <h2>Buat Perjalanan Anda</h2>
                            <div class="form-group">
                                <label for="" class="label">Lokasi Penjemputan</label>
                                <input type="text" class="form-control" placeholder="Lokasi Anda / Tempat Rental">
                            </div>
                            <div class="form-group">
                                <label for="" class="label">Lokasi Pengembalian</label>
                                <input type="text" class="form-control" placeholder="Lokasi Anda / Tempat Rental">
                            </div>
                            <div class="d-flex">
                                <div class="form-group mr-2">
                                    <label for="" class="label">Dari Tanggal</label>
                                    <input type="text" class="form-control" id="book_pick_date" placeholder="Tanggal">
                                </div>
                                <div class="form-group ml-2">
                                    <label for="" class="label">Sampai Tanggal</label>
                                    <input type="text" class="form-control" id="book_off_date" placeholder="Tanggal">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="label">Jam Penjemputan</label>
                                <input type="text" class="form-control" id="time_pick" placeholder="Waktu">
                            </div>
                            <div class="form-group">
                                <a href="{{ route('cars') }}" class="btn btn-secondary py-3 px-4">Rental Cepat</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="services-wrap rounded-right w-100">
                            <h2 class="heading-section mb-2">Hai, {{ auth()->user()->fullname }}</h2>
                            <span class="mb-4">Status Document:
                                @if(auth()->user()->customer->status_approval == 'On Procces')
                                <span class="text-primary">{{ auth()->user()->customer->status_approval }}</span>
                                @elseif(auth()->user()->customer->status_approval == 'Rejected')
                                <span class="text-danger">{{ auth()->user()->customer->status_approval }}</span>
                                <br>
                                <a href="{{ route('update.document', auth()->user()->id) }}" class="btn btn-warning">Ubah Document</a>
                                @else
                                <span class="text-success">{{ auth()->user()->customer->status_approval }}</span>
                                <br>
                                <span>Enjoy Rental...</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    @endif

                    @else
                    <div class="col-md-4 d-flex align-items-center">
                        <form action="#" class="request-form ftco-animate bg-primary">
                            <h2>Buat Perjalanan Anda</h2>
                            <div class="form-group">
                                <label for="" class="label">Lokasi Penjemputan</label>
                                <input type="text" class="form-control" placeholder="Lokasi Anda / Tempat Rental">
                            </div>
                            <div class="form-group">
                                <label for="" class="label">Lokasi Pengembalian</label>
                                <input type="text" class="form-control" placeholder="Lokasi Anda / Tempat Rental">
                            </div>
                            <div class="d-flex">
                                <div class="form-group mr-2">
                                    <label for="" class="label">Dari Tanggal</label>
                                    <input type="text" class="form-control" id="book_pick_date" placeholder="Tanggal">
                                </div>
                                <div class="form-group ml-2">
                                    <label for="" class="label">Sampai Tanggal</label>
                                    <input type="text" class="form-control" id="book_off_date" placeholder="Tanggal">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="label">Jam Penjemputan</label>
                                <input type="text" class="form-control" id="time_pick" placeholder="Waktu">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Rental Cepat" class="btn btn-secondary py-3 px-4">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="services-wrap rounded-right w-100">
                            <h3 class="heading-section mb-4">Cara Terbaik Untuk Merental Mobil</h3>
                            <div class="row d-flex mb-4">
                                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                    <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                                        <div class="text w-100">
                                            <h3 class="heading mb-2">Pilih Lokasi Penjemputan</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                    <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                                        <div class="text w-100">
                                            <h3 class="heading mb-2">Pilih Penawaran Terbaik</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                    <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                                        <div class="text w-100">
                                            <h3 class="heading mb-2">Lakukan Pemesanan Mobil</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p><a href="{{ route('cars') }}" class="btn btn-primary py-3 px-4">Pilih Mobil Terbaik Anda ></a></p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
</section>


<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <span class="subheading">Penarawan Kami</span>
                <h2 class="mb-2">Kendaraan Terbaru</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="carousel-car owl-carousel">
                    @foreach($latestCars as $i => $car)
                    <div class="item">
                        <div class="car-wrap rounded ftco-animate">
                            <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('cars') }}/{{ $car->images[0]->url }}');">
                            </div>
                            <div class="text">
                                <h2 class="mb-0"><a href="#">{{ $car->name }} <small>({{ $car->launch_year }})</small></a></h2>
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

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Layanan</span>
                <h2 class="mb-3">Layanan Terbaru Kami</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Cepat & Mudah</h3>
                        <p>Proses pemesanan cepat dan mudah.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Kualitas Terjamin</h3>
                        <p>Kami sudah pastikan kualitas kendaraan adalah kualitas terbaik.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Antar Kendaraan</h3>
                        <p>Kami dapat mengantarakan pesanan sewa mobil anda langsung kerumah.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Metode Pembayaran</h3>
                        <p>Ada banyak metode pembayaran yang dapat anda pilih.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-intro" style="background-image: url('{{ asset('build/assets/landing') }}/images/bg_3.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6 heading-section heading-section-white ftco-animate">
                <h2 class="mb-3">Ingin menjadi driver kami?</h2>
                <a href="https://api.whatsapp.com/send?phone=085157022076" target="_blank" class="btn btn-primary btn-lg" disabled>Daftar Menjadi Driver > </a>
            </div>
        </div>
    </div>
</section>


<section class="ftco-counter ftco-section img bg-light" id="section-counter">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="5">0</strong>
                        <span>Tahun <br>Pengalaman</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="50">0</strong>
                        <span>Jumlah <br>Mobil</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="1000">0</strong>
                        <span>Pelanggan<br>Happy</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text d-flex align-items-center">
                        <strong class="number" data-number="5">0</strong>
                        <span>Jumlah <br>Penilaian</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('script')


<script>
    $(document).ready(function() {

        $(document).on('click', '#cancelOrder', function(e) {
            let url = $(this).attr('data-url')
            const isConfirm = confirm('Batalkan order?, click "Ok" untuk melanjutkan')

            if (isConfirm) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: url,
                    type: "GET",
                    dataType: 'json',
                    success: function(response) {
                        location.reload();
                    },
                    error: function(err) {
                        location.reload();
                    },
                })
            }
        })
    })
</script>

@endpush