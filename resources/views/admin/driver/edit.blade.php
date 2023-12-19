@extends('admin.layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Detail Driver</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <span><a href="{{ route('driver.index') }}"><u>Driver</u></a></span>
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
                <form action="{{ route('driver.update', $driver->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="ibox-content">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nama Lengkap</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" required value="{{ $driver->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nomor Telepon</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="phone_number" required value="{{ $driver->phone_number }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Alamat</label>
                            <div class="col-md-9">
                                <textarea name="address" class="form-control" required rows="2">{{ $driver->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">KTP</label>
                            <div class="col-md-9">
                                <input type="file" name="ktp_image" class="form-control">
                                <a href="{{ asset('identity') }}/{{ $driver->ktp_image }}" target="_blank" data-gallery="">
                                    <img src="{{ asset('identity') }}/{{ $driver->ktp_image }}" width="150" height="150">
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">SIM</label>
                            <div class="col-md-9">
                                <input type="file" name="sim_image" class="form-control">
                                <a href="{{ asset('identity') }}/{{ $driver->sim_image }}" target="_blank" data-gallery="">
                                    <img src="{{ asset('identity') }}/{{ $driver->sim_image }}" width="150" height="150">
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="col-md-9">
                                <fieldset>
                                    <div class="form-check abc-checkbox abc-checkbox">
                                        @if($driver->status == 'Active')
                                        <input class="form-check-input" type="radio" name="status" value="Active" checked=>
                                        @else
                                        <input class="form-check-input" type="radio" name="status" value="Active">
                                        @endif
                                        <label class="form-check-label">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check abc-checkbox abc-checkbox-success">
                                        @if($driver->status == 'Nonactive')
                                        <input class="form-check-input" type="radio" name="status" value="Nonactive" checked=>
                                        @else
                                        <input class="form-check-input" type="radio" name="status" value="Nonactive">
                                        @endif
                                        <label class="form-check-label">
                                            Nonactive
                                        </label>
                                    </div>
                                </fieldset>
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