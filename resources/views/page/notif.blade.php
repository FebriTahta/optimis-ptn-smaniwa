@extends('layouts.master')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="text-xs font-weight-bold text-info text-uppercase mb-1">Status Notifikasi</span><br>
                                    <span class="text-xs font-weight-bold text-info text-uppercase mb-1">Notifikasi hanya diterima oleh user dengan role admin</span><br>
                                    {{-- <hr>
                                    <a href="#matikan_notif" id="btn_notif" class="btn btn-sm btn-warning"><i class="fa fa-bell"></i> <span id="status_notif">STATUS NOTIFIKASI</span></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-md-12 mb-12" style="margin-top: 20px">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Notif</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <span id="text">
                                            Berikut rekap data notifikasi berdasarkan rating yang dilakukan oleh siswa
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row no-gutters align-items-center" style="margin-top: 10px">
                        <div class="table-responsive">
                            <table id="example" class="display responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Notif</th>
                                        <th>Tanggal</th>
                                        <th style="width: 12%">Status</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 12px"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" id="modalnotif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabels">NOTIFIKASI</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <button style="width: 100%" class="btn btn-sm btn-primary" id="aktifkan_notif">AKTIFKAN</button>
                    </div>
                    <div class="col-md-6 col-6">
                        <button style="width: 100%" class="btn btn-sm btn-danger" id="matikan_notif">MATIKAN</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" id="cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

 
@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script>
    $(document).ready(function() {
        table_notif();
    });
    function table_notif() {
        var table = $('#example').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: "/admin-notif",
            columns: [{
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                
                {
                    data: 'pesan',
                    name: 'pesan'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'status_notif',
                    name: 'status_notif',
                    orderable: true,
                    searchable: true
                }
            ]
        });
    }
</script>
@endsection