@extends('admin.layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Detail Pemesanan</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <span><a href="{{ route('order.index') }}"><u>Pemesanan</u></a></span>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detail</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Data Pemesanan</h5>
                </div>
                <div class="ibox-content">
                    <table class="table">
                        <tr>
                            <th>Nomor Order</th>
                            <td>:</td>
                            <td>{{ $order->order_number }}</td>
                            <th>Tanggal Order</th>
                            <td>:</td>
                            <td>{{ date('d M Y - H:i', strtotime($order->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>Customer</th>
                            <td>:</td>
                            <td>{{ $order->user->fullname }}</td>
                            <th>Nomor Telepon</th>
                            <td>:</td>
                            <td>{{ $order->user->customer->phone_number }}</td>
                        </tr>
                    </table>
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
                    <table class="table">
                        <tr>
                            <th>Pembayaran</th>
                            <td>:</td>
                            <td>{{ $order->payment->payment_method->name }} <small class="text-primary">[{{ $order->payment->payment_status }}]</small></td>
                            <th>Total</th>
                            <td>:</td>
                            <td>Rp.{{ number_format($order->payment->grand_total, 0) }}</td>
                        </tr>
                    </table>
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

</div>

@endsection

@push('script')

@endpush