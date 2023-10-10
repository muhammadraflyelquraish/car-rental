<!-- Mainly scripts -->
<script src="{{ asset('build/assets/admin') }}/js/jquery-3.1.1.min.js"></script>
<script src="{{ asset('build/assets/admin') }}/js/popper.min.js"></script>
<script src="{{ asset('build/assets/admin') }}/js/bootstrap.js"></script>
<script src="{{ asset('build/assets/admin') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('build/assets/admin') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="{{ asset('build/assets/admin') }}/js/dataTables.min.js"></script>
<script src="{{ asset('build/assets/admin') }}/js/jquery.form-validator.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('build/assets/admin') }}/js/inspinia.js"></script>
<script src="{{ asset('build/assets/admin') }}/js/plugins/pace/pace.min.js"></script>

<!-- Sweet alert -->
<script src="{{ asset('build/assets/admin') }}/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Ladda -->
<script src="{{ asset('build/assets/admin') }}/js/plugins/ladda/spin.min.js"></script>
<script src="{{ asset('build/assets/admin') }}/js/plugins/ladda/ladda.min.js"></script>
<script src="{{ asset('build/assets/admin') }}/js/plugins/ladda/ladda.jquery.min.js"></script>

<script src="{{ asset('build/assets/admin') }}/js/plugins/iCheck/icheck.min.js"></script>

<script>
    $(document).ready(function() {
        //Ajax CSRF TOKEN Declare
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //LIFE TIME
        setInterval(lifeTime, 1000);

        function lifeTime() {
            let options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            let today = new Date;
            let date = today.toLocaleTimeString('id-ID', options).split(' ');
            let day = (date[0].length <= 1) ? 0 + date[0] : date[0];
            let second = date[4].split('.');
            $('#lifeTime').text(day + ' ' + date[1] + ' ' + date[2] + ' - ' + second[0] + ':' + second[1] + ':' + second[2]);
        }

        // F2 for Modal Open
        document.onkeydown = function(e) {
            (e.keyCode == 113) ? $('#ModalAddEdit').modal('show'): false;
        }

        //Textarea when Enter FIX
        textareaEnterFix()

        function textareaEnterFix() {
            $("textarea").each(function() {
                $(this).on("keypress", function(e) {
                    if (e.keyCode === 13) {
                        $('#submit').click()
                    }
                });
            });
        }


        //Logout
        $(document).on('click', '#logout', function(e) {
            swal({
                title: "Logout?",
                text: 'Click "Ya" untuk melanjutkan',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Logout!",
                closeOnConfirm: false
            }, function() {
                swal.close();
                $.ajax({
                    url: "{{ route('logout') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = "{{ route('auth.index') }}"
                    },
                })
            });
        })
    })
</script>
@stack('script')