<!DOCTYPE html>
<html lang="en">

<head>
    <title>Carbook | Easy Rental</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/animate.css">

    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/magnific-popup.css">

    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/aos.css">

    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/jquery.timepicker.css">


    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/icomoon.css">
    <link rel="stylesheet" href="{{ asset('build/assets/landing') }}/css/style.css">

    @stack('css')
</head>

<body>

    @include('landing.layouts.sidebar')
    <!-- END nav -->

    @yield('content')


    @include('landing.layouts.footer')

</body>

</html>