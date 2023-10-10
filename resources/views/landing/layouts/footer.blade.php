<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2"><a href="#" class="logo">Car<span>book</span></a></h2>
                    <p>Temukan Kenyamanan yang Sempurna: Carbook adalah Rental yang dapat Memenuhi Kebutuhan Anda.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Informasi</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="py-2 d-block">Home</a></li>
                        <li><a href="{{ route('about') }}" class="py-2 d-block">Tentang Kami</a></li>
                        <li><a href="{{ route('cars') }}" class="py-2 d-block">Daftar Mobil</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Support</h2>
                    <ul class="list-unstyled">
                        <li><a href="https://api.whatsapp.com/send?phone=085157022076" target="_blank">Menjadi Driver Kami?</a></a></li>
                        <li><a href="{{ route('contact') }}" class="py-2 d-block">Hubungi Kami</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Punya Pertanyaan?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">Jl. KH Abdullah Bin Nuh No.100, Sawah Gede, Kec. Cianjur, Kabupaten Cianjur, Jawa Barat 43212</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">+62 858-6079-3006</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">help@carbook.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    &copy; <small>{{ date('Y') }} &bullet; Carbook - Cepat & Mudah Sewa Mobil</small>
                </p>
            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>


<script src="{{ asset('build/assets/landing') }}/js/jquery.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/jquery-migrate-3.0.1.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/popper.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/jquery.easing.1.3.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/jquery.waypoints.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/jquery.stellar.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/aos.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/jquery.animateNumber.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/jquery.timepicker.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/scrollax.min.js"></script>
<script src="{{ asset('build/assets/landing') }}/https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset('build/assets/landing') }}/js/google-map.js"></script>
<script src="{{ asset('build/assets/landing') }}/js/main.js"></script>
<!-- Sweet alert -->
<script src="{{ asset('build/assets/admin') }}/js/plugins/sweetalert/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {

        if ("{{Session::has('success')}}") {
            alert("{{ Session::get('success') }}")
        }

        if ("{{Session::has('failed')}}") {
            alert("{{ Session::get('failed') }}")
        }

        function sweetalert(title, msg, type, timer = 60000, confirmButton = true) {
            swal({
                title: title,
                text: msg,
                type: type,
                timer: timer,
                showConfirmButton: confirmButton
            });
        }

        $(document).on('click', '#logout', function(e) {
            const isConfirm = confirm('Logout?, click "Ok" untuk melanjutkan')
            if (isConfirm) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ route('logout') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        window.location.reload()
                    },
                })
            }
        })
    })
</script>

@stack('script')