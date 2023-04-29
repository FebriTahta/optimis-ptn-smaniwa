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
                                    <form id="formlink">@csrf
                                        <input type="hidden" name="link_id" id="link_id">
                                        <span class="text-xs font-weight-bold text-info text-uppercase mb-1">Ex: smaniwa.com</span>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" style="margin-bottom: 20px; width: 100%" name="link" id="link" class="form-control" placeholder="TAUTAN LINK WEBSITE...">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" class="btn btn-success" id="btn_link" value="save" style="width: 100%; margin-bottom: 20px">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="col-md-4 col-12">
                                    <input type="hidden" value="{{auth()->user()->web_token}}" id="status_notif_text">
                                    <a href="#notif" data-toggle="modal" data-target="#modalnotif" style="margin-bottom: 20px" id="notif" class="btn btn-warning"><i class="fa fa-bell"></i>
                                        <span class="text-xs font-weight-bold text-white text-uppercase mb-1" id="status_notif">STATUS NOTIF</span>
                                    </a>
                                </div> --}}
                            </div>
                            <hr>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">laporan hasil rating siswa</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" style="margin-bottom: 10px">
                            <select name="angkatan" id="angkatan" class="form-control" required>
                                <option value="">ANGKATAN</option>
                                @for ($i = date('Y')-5; $i <= date('Y'); $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 col-6" style="margin-bottom: 10px">
                            <a href="" class="btn btn-primary" id="download" style="width: 100%">
                                <i class="fa fa-download"></i>
                            </a>
                        </div>
                        <div class="col-md-4 col-6" style="margin-bottom: 10px">
                            <button class="btn btn-danger" id="reset" style="width: 100%">
                                <i class="fa fa-minus"></i>
                                </button>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Report</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <span id="text">
                                            Berikut data laporan hasil rating tiap siswa berdasarkan angkatan
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
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th style="width: 12%">Status</th>
                                        <th>Pilihan 1</th>
                                        <th>Pilihan 2</th>
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
        table_report();
        status_notif();
        data_link();
        $("#download").attr("href", "/admin-export-report/x");
    });
    
    function status_notif() {
        var status_notif = $('#status_notif_text').val();
        if (status_notif == null || status_notif == "") {
            $('#status_notif').html('NOTIFIKASI NON AKTIF');
        }else{
            $('#status_notif').html('NOTIFIKASI AKTIF');
        }
    }

    $("#cancel").click(function(){
        $("#modalnotif").modal("hide");
    });
    $("#modalnotif").on('hide.bs.modal', function(){});

    $('#matikan_notif').on('click', function () {
        $.ajax({
            type: 'GET',
            url: '/matikan-notif',
            success: function(response) {
                if (response.status == 200) {
                    $("#modalnotif").on('hide.bs.modal', function(){});
                    $('#status_notif').html('NOTIFIKASI NON AKTIF');
                    toastr.error(response.message);
                }else{
                    toastr.error('error');
                }
            }
        });
    })

    // function sentTokenToServer(token){
    //     var csrf = document.querySelector('meta[name="csrf-token"]')
    //     .getAttribute("content");

    //     let formData = new FormData();

    //     formData.append("token",token);
        
    //     fetch("/tokenweb",{
    //         headers: {
    //             "X-CSRF-Token": csrf,
    //             _method:"_POST",
    //         },
    //         method: "post",
    //         credentials: "same-origin",
    //         body: formData,
    //     }).then((response)=>{
    //         console.log(response);
    //         toastr.success('NOTIFIKASI AKTIF');
    //         $('#status_notif').html('NOTIFIKASI AKTIF');
    //     })
    // }

    function data_link() {
        $.ajax({
            type: 'GET',
            url: '/get-link',
            success: function(response) {
                if (response.status == 200) {
                    $('#link_id').val(response.link_id);
                    $('#link').val(response.link);   
                    toastr.success(response.message);
                }else{
                    toastr.error(response.message);  
                }
            }
        });
    }

    $('#formlink').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "/update-link",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#btn_link').attr('disabled', 'disabled');
                $('#btn_link').val('Process...');
            },
            success: function(response) {
                if (response.status == 200) {
                    $('#btn_link').val('save');
                    $('#btn_link').attr('disabled', false);
                    toastr.success(response.message);
                    data_link();
                } else {
                    $('#btn_link').val('save');
                    $('#btn_link').attr('disabled', false);
                    toastr.error(response.message);
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    $('#aktifkan_notif').on('click', function (token) {
        var csrf = document.querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

        let formData = new FormData();

        formData.append("token",token);
        
        fetch("/tokenweb",{
            headers: {
                "X-CSRF-Token": csrf,
                _method:"_POST",
            },
            method: "post",
            credentials: "same-origin",
            body: formData,
        }).then((response)=>{
            console.log(response);
            toastr.success('NOTIFIKASI AKTIF');
            $('#status_notif').html('NOTIFIKASI AKTIF');
        })
    })

    function table_report() {
        var table = $('#example').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: "/admin-report",
            columns: [{
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                
                {
                    data: 'siswa_name',
                    name: 'siswa_name'
                },
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'pilihan_1',
                    name: 'pilihan_1'
                },
                {
                    data: 'pilihan_2',
                    name: 'pilihan_2'
                },
                
            ]
        });
    }

    var angkatan;
    $('#angkatan').on('change', function() {
        // alert(this.value);
        angkatan = this.value;
        $("#download").attr("href", "/admin-export-report/"+angkatan);
        if (this.value == new Date().getFullYear() || this.value == "") {
            table_report();
            $('#angkatan').val(new Date().getFullYear());
        }else{
            var table = $('#example').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: "/admin-filter/"+this.value,
                columns: [{
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    
                    {
                        data: 'siswa_name',
                        name: 'siswa_name'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'pilihan_1',
                        name: 'pilihan_1'
                    },
                    {
                        data: 'pilihan_2',
                        name: 'pilihan_2'
                    },
                    
                ]
            });  
        }  
    })
    
    $('#reset').on('click', function () {
        table_report();
        $('#angkatan').val(new Date().getFullYear());
    });
</script>
@endsection