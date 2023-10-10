<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Carbook | Register</title>

    <link href="{{ asset('build/assets/admin') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('build/assets/admin') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('build/assets/admin') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('build/assets/admin') }}/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="{{ asset('build/assets/admin') }}/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">

    <link href="{{ asset('build/assets/admin') }}/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="{{ asset('build/assets/admin') }}/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="{{ asset('build/assets/admin') }}/css/plugins/codemirror/codemirror.css" rel="stylesheet">

    <link href="{{ asset('build/assets/admin') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('build/assets/admin') }}/css/style.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Rubik', sans-serif;
        }
    </style>

</head>

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox-content">
                    <h2 class="font-bold">Carbook</h2>
                    <p>
                        Mohon lengkapi form registrasi dibawah.
                    </p>
                    <form class="m-t" role="form" method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}" required autofocus>
                            @if($errors->has('fullname'))
                            <small class="text-danger">{{ $errors->first('fullname') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
                            @if($errors->has('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Telepon</label>
                            <input type="number" class="form-control" value="{{ old('phone_number') }}" name="phone_number" required>
                            @if($errors->has('phone_number'))
                            <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Alamat Lengkap (Saat ini)</label>
                            <textarea name="address" class="form-control" rows="2" required>{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                            <small class="text-danger">{{ $errors->first('address') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Foto KTP</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input id="inputGroupFile01" type="file" name="ktp_image" class="custom-file-input">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            @if($errors->has('ktp_image'))
                            <small class="text-danger">{{ $errors->first('ktp_image') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Foto SIM</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input id="inputGroupFile02" type="file" name="sim_image" class="custom-file-input">
                                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                </div>
                            </div>
                            @if($errors->has('sim_image'))
                            <small class="text-danger">{{ $errors->first('sim_image') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" autocomplete="off" name="password" required value="{{ old('password') }}">
                            @if($errors->has('password'))
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Konfirmasi Password</label>
                            <input type="password" class="form-control" autocomplete="off" name="password_confirmation" required>
                            @if($errors->has('password_confirmation'))
                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                            @endif
                        </div>


                        <button type="submit" class="btn btn-primary block full-width m-b ladda-button ladda-button-demo" data-style="zoom-in">Registrasi</button>

                        <p class="text-muted text-center">
                            <small><a href="{{ route('auth.index') }}">Sudah punya akun?</a></small>
                        </p>
                    </form>

                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                &copy; <small>{{ date('Y') }} &bullet; Carbook - Cepat & Mudah Sewa Mobil</small>
            </div>

        </div>
    </div>

    <script src="{{ asset('build/assets/admin') }}/js/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('build/assets/admin') }}/js/plugins/iCheck/icheck.min.js"></script>
    <script src="{{ asset('build/assets/admin') }}/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="{{ asset('build/assets/admin') }}/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Ladda -->
    <script src="{{ asset('build/assets/admin') }}/js/plugins/ladda/spin.min.js"></script>
    <script src="{{ asset('build/assets/admin') }}/js/plugins/ladda/ladda.min.js"></script>
    <script src="{{ asset('build/assets/admin') }}/js/plugins/ladda/ladda.jquery.min.js"></script>

    <script src="{{ asset('build/assets/admin') }}/js/popper.min.js"></script>
    <script src="{{ asset('build/assets/admin') }}/js/bootstrap.js"></script>
    <script src="{{ asset('build/assets/admin') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('build/assets/admin') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('build/assets/admin') }}/js/inspinia.js"></script>
    <script src="{{ asset('build/assets/admin') }}/js/plugins/pace/pace.min.js"></script>

    <!-- BS custom file -->
    <script src="{{ asset('build/assets/admin') }}/js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>

    <script>
        $(document).ready(function() {
            bsCustomFileInput.init()

        })
    </script>
</body>

</html>