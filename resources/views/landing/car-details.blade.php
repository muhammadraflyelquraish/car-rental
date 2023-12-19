@extends('landing.layouts.master')

@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('build/assets/landing') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Detail Mobil<i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Detail Mobil & Pemesanan</h1>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section ftco-car-details">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="car-details">
                    <div class="img rounded" style="background-image: url('{{ asset('cars') }}/{{ $car->images[0]->url }}');"></div>
                    <div class="text text-center">
                        <span class="subheading">{{ $car->brand->name }}</span>
                        <h2>{{ $car->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services">
                    <div class="media-body py-md-4">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-dashboard"></span></div>
                            <div class="text">
                                <h3 class="heading mb-0 pl-3">
                                    Jarak Tempuh
                                    <span>{{ number_format($car->mileage, 0) }} KM</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services">
                    <div class="media-body py-md-4">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-pistons"></span></div>
                            <div class="text">
                                <h3 class="heading mb-0 pl-3">
                                    Transmisi
                                    <span>{{ $car->transmission }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services">
                    <div class="media-body py-md-4">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat"></span></div>
                            <div class="text">
                                <h3 class="heading mb-0 pl-3">
                                    Kursi
                                    <span>{{ $car->number_of_seat }} Dewasa</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services">
                    <div class="media-body py-md-4">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-diesel"></span></div>
                            <div class="text">
                                <h3 class="heading mb-0 pl-3">
                                    Bahan Bakar
                                    <span>{{ $car->fuel_type }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pills">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="head">Aksesoris</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="features">
                                    @foreach($car->accessories as $acc)
                                    @if($loop->iteration <= 7) <li class="{{ $acc->is_featured ? 'check' : 'remove' }}"><span class="{{ $acc->is_featured ? 'ion-ios-checkmark' : 'ion-ios-close' }}"></span>{{ $acc->name }}</li>
                                        @endif
                                        @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="features">
                                    @foreach($car->accessories as $acc)
                                    @if($loop->iteration > 7)
                                    <li class="{{ $acc->is_featured ? 'check' : 'remove' }}"><span class="{{ $acc->is_featured ? 'ion-ios-checkmark' : 'ion-ios-close' }}"></span>{{ $acc->name }}</li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rating-wrap">
                            <h3 class="head">Form Pemesanan</h3>
                            <form action="{{ route('checkout.store') }}" method="post" class="form-request">
                                @csrf
                                @method('POST')

                                <input type="hidden" class="form-control" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" class="form-control" name="car_id" value="{{ $car->id }}">

                                <div class="form-group">
                                    <label for="" class="label">Lokasi Penjemputan (kosongkan jika lokasi tempat rental)</label>
                                    <textarea name="pickup_location" id="pickup_location" rows="2" class="form-control" placeholder="Lokasi Anda / Tempat Rental"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Lokasi Pengembalian (kosongkan jika lokasi tempat rental)</label>
                                    <textarea name="dropoff_location" id="dropoff_location" rows="2" class="form-control" placeholder="Lokasi Anda / Tempat Rental"></textarea>
                                </div>
                                <div class="d-flex row">
                                    <div class="col-md-6">
                                        <div class="form-group mr-2">
                                            <label for="" class="label">Dari Tanggal</label>
                                            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Tanggal" value="{{ date('Y-m-d') }}">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ml-2">
                                            <label for="" class="label">Sampai Tanggal</label>
                                            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Tanggal" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Menggunakan Driver?</label>
                                    <select id="use_driver" class="form-control" required>
                                        <option value="Tidak" selected>Tidak</option>
                                        <option value="Ya">Ya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label" hidden>Driver</label>
                                    <select name="driver_id" id="driver_id" class="form-control" hidden>
                                        <option value="">-- Pilih Driver --</option>
                                        @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Jam Pengambilan & Pengembalian</label>
                                    <input type="time" class="form-control" name="pickup_time" id="pickup_time" placeholder="Waktu" required value="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Metode Pembayaran</label>
                                    <select name="payment_method_id" id="payment_method_id" class="form-control" required>
                                        @foreach($payment_methods as $payment)
                                        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex row">
                                    <div class="col-md-6">
                                        <div class="form-group mr-2">
                                            <label for="" class="label">Harga/Hari</label>
                                            <input type="text" class="form-control" id="price_text" readonly value="{{ number_format($car->price_per_day, 0) }}">
                                            <input type="hidden" class="form-control" name="price" id="price" value="{{ $car->price_per_day }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mr-2">
                                            <label for="" class="label">Quantity (Hari)</label>
                                            <input type="text" class="form-control" name="quantity" id="quantity" readonly value="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Total Bayar</label>
                                    <input type="text" class="form-control" id="grand_total_text" readonly value="0">
                                    <input type="hidden" class="form-control" name="grand_total" id="grand_total" readonly value="0">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary py-3 px-4">Rental Sekarang</button>
                                </div>
                            </form>
                        </div>
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
        calc_grant_total()

        function calc_grant_total() {
            let price = $('#price').val()

            let startDate = new Date($('#start_date').val());
            let endDate = new Date($('#end_date').val());

            if (endDate >= startDate) {
                let timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                if (diffDays > 0) {
                    let grandTotal = (parseInt(price) * diffDays)
                    $('#quantity').val(diffDays)
                    $('#grand_total_text').val(parseInt(grandTotal).toLocaleString())
                    $('#grand_total').val(grandTotal)
                }

            } else {
                alert('Tanggal Selesai tidak boleh kurang dari waktu mulai')
            }
        }

        $(document).on('change', '#use_driver', function(e) {
            let val = $(this).val()
            if (val == 'Ya') {
                $('#driver_id').prop('hidden', false)
                $('#driver_id').prop('required', true)
                $('#driver_id').prev().prop('hidden', false)
            } else {
                $('#driver_id').prop('hidden', true)
                $('#driver_id').prop('required', false)
                $('#driver_id').prev().prop('hidden', true)
            }
        })

        $(document).on('change', '#start_date', function(e) {
            let currentTime = new Date();
            let targetDate = new Date($(this).val());
            if (targetDate <= currentTime) {
                $('#start_date').val("{{ date('Y-m-d') }}")
            }
            calc_grant_total()
        })

        $(document).on('change', '#end_date', function(e) {
            let currentTime = new Date();
            let targetDate = new Date($(this).val());
            if (targetDate <= currentTime) {
                $('#end_date').val("{{ date('Y-m-d', strtotime('+1 day')) }}")
            }
            calc_grant_total()
        })

        // $(document).on('change', '#pickup_time', function(e) {
        //     var inputTimeValue = $(this).val();
        //     var currentTime = new Date();

        //     var inputTime = new Date('1970-01-01T' + inputTimeValue + ':00');

        //     if ((inputTime.getHours() + ':' + inputTime.getMinutes()) < (currentTime.getHours() + ':' + currentTime.getMinutes())) {
        //         alert("Waktu penjemputan tidak boleh kurang dari jam saat ini");
        //     }
        // })
    })
</script>

@endpush