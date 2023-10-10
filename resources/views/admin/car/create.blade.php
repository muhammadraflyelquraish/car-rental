@extends('admin.layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tambah Mobil</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <span><a href="{{ route('car.index') }}"><u>Mobil</u></a></span>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Data Mobil</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('car.store') }}" method="post" id="formCar" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class=" row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nama Mobil</label>
                                    <input type="text" name="name" class="form-control" required placeholder="Contoh: Avanza">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Plat Nomor</label>
                                    <input type="text" name="number_plate" class="form-control" required placeholder="Contoh: Z 1234 AB">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control" required>
                                <option value="" selected disabled>Pilih Brand</option>
                                @foreach($brands as $id => $brand)
                                <option value="{{ $id }}">{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Keluar</label>
                                    <input type="number" class="form-control" name="launch_year" min="1900" max="2099" step="1" required placeholder="Contoh: 1990">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jarak Tempuh (KM)</label>
                                    <input type="number" class="form-control" name="mileage" required placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Transmisi</label>
                                    <select name="transmission" class="form-control" required>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Otomatis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bahan Bakar</label>
                                    <select name="fuel_type" class="form-control" required>
                                        <option value="Petrol">Bensin</option>
                                        <option value="Electric">Listrik</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Duduk</label>
                                    <input type="number" class="form-control" name="number_of_seat" placeholder="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga per Hari (Rp)</label>
                                    <input type="number" class="form-control" name="price_per_day" placeholder="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" id="description" cols="30" rows="2" class="form-control"></textarea>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <h5>Aksesoris</h5>

                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Fitur</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Airconditions</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Airconditions">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Child Seat</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Child Seat">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>GPS</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="GPS">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lugage</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Lugage">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Musik</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Musik">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Seat Belt</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Seat Belt">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sleeping Bed</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Sleeping Bed">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bluetooth</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Bluetooth">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>On Board Computer</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="On Board Computer">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Audio Input</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Audio Input">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Long Term Trips</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Long Term Trips">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Car Kit</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Car Kit">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Remote Central Locking</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Remote Central Locking">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Climate Control</td>
                                    <td class="text-center">
                                        <input type="hidden" class="form-control" name="accessories_name[]" value="Climate Control">
                                        <input type="hidden" name="accessories_value[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="hr-line-dashed"></div>

                        <h5>Gambar Mobil</h5>
                        <button type="button" class="btn btn-primary btn-xs mb-3" id="addImage"><i class="fa fa-plus"></i> gambar</button>

                        <div class="imageList">
                            <div class="form-group">
                                <label>Gambar 1</label>
                                <input type="file" name="images[]" class="form-control" required>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-12 col-sm-offset-2">
                                <button class="btn btn-primary float-right" type="submit"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '#addImage', function(e) {
            let elementImage = $('#formCar').find('.imageList')
            let iteration = elementImage.find('div').length

            elementImage.append(
                `<div class="form-group">
                    <label>Gambar ${iteration+1}</label>
                    <input type="file" name="images[]" class="form-control">
                </div>`
            )
        })
    });
</script>
@endpush