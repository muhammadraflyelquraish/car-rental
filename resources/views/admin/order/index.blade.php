@extends('admin.layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Pemesanan</h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-title">
                <h5><a class="btn btn-primary btn-sm" href="{{ route('order.export') }}" target="_blank"><i class="fa fa-plus-square mr-1"></i> Export Pemesanan</a></h5>
            </div>
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover driverTable" width="100%">
                            <thead>
                                <tr>
                                    <th width="1px">No</th>
                                    <th>Nomor Order</th>
                                    <th>Customer</th>
                                    <th>Mobil</th>
                                    <th>Masa Rental</th>
                                    <th>Lokasi Pengambilan</th>
                                    <th>Lokasi Pengembalian</th>
                                    <th>Status</th>
                                    <th class="text-right" width="1px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        //BASE 
        let ladda = $('.ladda-button-demo').ladda();

        function LaddaStart() {
            ladda.ladda('start');
        }

        function LaddaAndDrawTable() {
            ladda.ladda('stop');
            serverSideTable.draw()
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

        //TEMPLATES 
        let serverSideTable = $('.driverTable').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: {
                url: "{{ route('order.create') }}",
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false,
            }, {
                data: 'order_number',
                name: 'order_number'
            }, {
                data: 'user.fullname',
                name: 'user.fullname'
            }, {
                data: 'car.name',
                name: 'car.name'
            }, {
                data: 'start_date',
                name: 'start_date'
            }, {
                data: 'pickup_location',
                name: 'pickup_location'
            }, {
                data: 'dropoff_location',
                name: 'dropoff_location'
            }, {
                data: 'order_status',
                name: 'order_status'
            }, {
                data: 'action',
                name: 'action',
                searchable: false,
                orderable: false
            }],
            search: {
                "regex": true
            }
        });

        $(document).on('click', '#delete', function(e) {
            let id = $(this).data('integrity')
            let name = $(this).closest('tr').find('td:eq(1)').text()
            swal({
                title: "Batalkan?",
                text: `Order "${name}" akan dibatalkan!`,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus!",
                closeOnConfirm: false
            }, function() {
                swal.close()
                $.ajax({
                    url: "{{ route('order.store') }}/" + id,
                    type: "DELETE",
                    dataType: 'json',
                    success: function(response) {
                        LaddaAndDrawTable()
                        sweetalert('Berhasil', `Data berhasil dibatalkan.`, null, 500, false)
                    },
                    error: function(response) {
                        LaddaAndDrawTable()
                        sweetalert('Tidak terhapus!', 'Terjadi kesalahan saat mengubah data.', 'error')
                    }
                })
            });
        })

        $(document).on('click', '#ongoing', function(e) {
            let url = $(this).data('url')
            let name = $(this).closest('tr').find('td:eq(1)').text()
            swal({
                title: "On going?",
                text: `Order "${name}" akan diubah menjadi ongoing!`,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1c84c6",
                confirmButtonText: "Ya, Ubah!",
                closeOnConfirm: false
            }, function() {
                swal.close()
                $.ajax({
                    url: url,
                    type: "PUT",
                    dataType: 'json',
                    success: function(response) {
                        LaddaAndDrawTable()
                        sweetalert('Berhasil', `Data berhasil dibatalkan.`, null, 500, false)
                    },
                    error: function(response) {
                        LaddaAndDrawTable()
                        sweetalert('Tidak terhapus!', 'Terjadi kesalahan saat mengubah data.', 'error')
                    }
                })
            });
        })

        $(document).on('click', '#finish', function(e) {
            let url = $(this).data('url')
            let name = $(this).closest('tr').find('td:eq(1)').text()
            swal({
                title: "Selesai Order?",
                text: `Order "${name}" akan diubah menjadi selesai!`,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1c84c6",
                confirmButtonText: "Ya, Selesai!",
                closeOnConfirm: false
            }, function() {
                swal.close()
                $.ajax({
                    url: url,
                    type: "PUT",
                    dataType: 'json',
                    success: function(response) {
                        LaddaAndDrawTable()
                        sweetalert('Berhasil', `Data berhasil dibatalkan.`, null, 500, false)
                    },
                    error: function(response) {
                        LaddaAndDrawTable()
                        sweetalert('Tidak terhapus!', 'Terjadi kesalahan saat mengubah data.', 'error')
                    }
                })
            });
        })

    });
</script>
@endpush