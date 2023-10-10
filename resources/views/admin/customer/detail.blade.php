@extends('admin.layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Detail Customer</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <span><a href="{{ route('customer.index') }}"><u>Customer</u></a></span>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detail</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Data Customer</h5>
                </div>
                <form action="{{ route('customer.update', $customer->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="ibox-content">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nama Lengkap</label>
                            <div class="col-md-9">
                                <input type="text" name="fullname" class="form-control" required value="{{ $customer->user->fullname }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" required readonly value="{{ $customer->user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nomor Telepon</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" required readonly value="{{ $customer->phone_number }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Alamat</label>
                            <div class="col-md-9">
                                <textarea name="address" class="form-control" required rows="2">{{ $customer->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">KTP</label>
                            <div class="col-md-9">
                                <input type="file" name="ktp_image" class="form-control">
                                <a href="{{ asset('identity') }}/{{ $customer->ktp_image }}" target="_blank" data-gallery="">
                                    <img src="{{ asset('identity') }}/{{ $customer->ktp_image }}" width="150" height="150">
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">SIM</label>
                            <div class="col-md-9">
                                <input type="file" name="sim_image" class="form-control">
                                <a href="{{ asset('identity') }}/{{ $customer->sim_image }}" target="_blank" data-gallery="">
                                    <img src="{{ asset('identity') }}/{{ $customer->sim_image }}" width="150" height="150">
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="col-md-9">
                                <fieldset>
                                    <div class="form-check abc-checkbox abc-checkbox">
                                        @if($customer->status_approval == 'On Procces')
                                        <input class="form-check-input" type="radio" name="status_approval" value="On Procces" checked=>
                                        @else
                                        <input class="form-check-input" type="radio" name="status_approval" value="On Procces">
                                        @endif
                                        <label class="form-check-label">
                                            Proccess
                                        </label>
                                    </div>
                                    <div class="form-check abc-checkbox abc-checkbox-success">
                                        @if($customer->status_approval == 'Approved')
                                        <input class="form-check-input" type="radio" name="status_approval" value="Approved" checked=>
                                        @else
                                        <input class="form-check-input" type="radio" name="status_approval" value="Approved">
                                        @endif
                                        <label class="form-check-label">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check abc-checkbox abc-checkbox-danger">
                                        @if($customer->status_approval == 'Rejected')
                                        <input class="form-check-input" type="radio" name="status_approval" value="Rejected" checked=>
                                        @else
                                        <input class="form-check-input" type="radio" name="status_approval" value="Rejected">
                                        @endif
                                        <label class="form-check-label">
                                            Reject
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Note</label>
                            <div class="col-md-9">
                                <textarea name="note" class="form-control" required rows="2">{{ $customer->note }}</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-12 col-sm-offset-2">
                                <button class="btn btn-primary float-right" type="submit"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@push('script')

@endpush