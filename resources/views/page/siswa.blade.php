@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
            <a href="#" data-toggle="modal" data-target="#modalimport"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-upload fa-sm text-white-50"></i> Import Siswa ".xlsx"</a>
            {{-- <a href="/generate-user-and-siswa"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-upload fa-sm text-white-50"></i> Generate User & Siswa</a> --}}
            {{-- <a href="/admin-siswa-export"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Download Siswa</a> --}}
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total SISWA</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span id="total"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-md-12">
                <div class="table-responsive">
                    <table id="example" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama Siswa</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Angkatan</th>
                                <th>Nilai</th>
                                <th>Ranking</th>
                                <th>Sertifikat</th>
                                <th>Kota</th>
                                <th style="width: 12%">Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/admin-import-siswa" enctype="multipart/form-data" method="POST">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import data siswa?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="file" id="file" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formupdate" enctype="multipart/form-data" method="POST">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">UPDATE DATA SISWA?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" id="id" name="id" required>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Siswa</label>
                                    <input type="text" class="form-control" name="siswa_name" id="siswa_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input type="number" class="form-control" name="siswa_nisn" id="siswa_nisn" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan_kelas" id="jurusan_kelas" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Angkatan</label>
                                    <input type="number" class="form-control" name="angkatan" id="angkatan" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control" name="kota" id="kota" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ranking</label>
                                    <input type="number" class="form-control" name="siswa_ranking" id="siswa_ranking" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <input type="number" class="form-control" name="siswa_nilai" id="siswa_nilai" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sertifikat</label>
                                    <input type="number" class="form-control" name="siswa_sertifikat" id="siswa_sertifikat" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Update" id="btnedit">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formhapus" enctype="multipart/form-data" method="POST">@csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color: red">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: white">Hapus User?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <code>Apakah yakin akan menghapus user tersebut ? <br>
                            seluruh data yang berhubungan dengan user tersebut juga akan ikut terhapus</code>
                            <input type="hidden" class="form-control" placeholder="id" name="id" id="id" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" id="btnhapus" class="btn btn-sm btn-danger" value="HAPUS">
                    </div>
                </div>
            </form>
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
            table_siswa();
            total();
        });
        $('#modaledit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var kota = button.data('kota')
            var angkatan = button.data('angkatan')
            var nama_kelas = button.data('nama_kelas')
            var jurusan_kelas = button.data('jurusan_kelas')
            var siswa_name = button.data('siswa_name')
            var siswa_nisn = button.data('siswa_nisn')
            var siswa_ranking = button.data('siswa_ranking')
            var siswa_sertifikat = button.data('siswa_sertifikat')
            var siswa_nilai = button.data('siswa_nilai')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #kota').val(kota);
            modal.find('.modal-body #angkatan').val(angkatan);
            modal.find('.modal-body #nama_kelas').val(nama_kelas);
            modal.find('.modal-body #jurusan_kelas').val(jurusan_kelas);
            modal.find('.modal-body #siswa_name').val(siswa_name);
            modal.find('.modal-body #siswa_nisn').val(siswa_nisn);
            modal.find('.modal-body #siswa_ranking').val(siswa_ranking);
            modal.find('.modal-body #siswa_sertifikat').val(siswa_sertifikat);
            modal.find('.modal-body #siswa_nilai').val(siswa_nilai);
        })

        $('#formupdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-update-siswa",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnedit').attr('disabled', 'disabled');
                    $('#btnedit').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#btnedit').val('Update');
                        $('#btnedit').attr('disabled', false);
                        $('#modaledit').modal('hide');
                        var oTable = $('#example').dataTable();
                        oTable.fnDraw(false);
                        
                        toastr.success(response.message);
                    } else {
                        $('#btnedit').val('Update');
                        $('#btnedit').attr('disabled', false);
                        toastr.error(response.message);
                        $('#errList').html("");
                        $('#errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#errList').append('<div>' + err_values + '</div>');
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        function table_siswa() {
            var table = $('#example').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: "/data-siswa",
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
                        data: 'siswa_nisn',
                        name: 'siswa_nisn'
                    }, 
                    {
                        data: 'nama_kelas',
                        name: 'nama_kelas'
                    },
                    {
                        data: 'jurusan_kelas',
                        name: 'jurusan_kelas'
                    },
                    {
                        data: 'angkatan',
                        name: 'angkatan'
                    },
                    {
                        data: 'siswa_nilai',
                        name: 'siswa_nilai'
                    },
                    {
                        data: 'siswa_ranking',
                        name: 'siswa_ranking'
                    },
                    {
                        data: 'siswa_sertifikat',
                        name: 'siswa_sertifikat'
                    },
                    {
                        data: 'kota',
                        name: 'kota'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        }

        function total() {
            $.ajax({
                type: 'GET',
                url: '/total-siswa',
                success: function(response) {
                    $('#total').html(response.data);
                }
            });
        }

        $('#modalhapus').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            })

            $('#formhapus').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/admin-hapus-siswa",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnhapus').attr('disabled', 'disabled');
                        $('#btnhapus').val('Process...');
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            var table = $('#example').DataTable();
                            table.ajax.reload();
                            $('#modalhapus').modal('hide');
                            $("#formhapus")[0].reset();
                            $('#btnhapus').val('HAPUS');
                            $('#btnhapus').attr('disabled', false);
                            toastr.success(response.message);
                            total();
                        } else {
                            $('#btnhapus').val('SUBMIT!');
                            $('#btnhapus').attr('disabled', false);
                            toastr.error(response.message);
                            $('#errList').html("");
                            $('#errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#errList').append('<div>' + err_values + '</div>');
                            });
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
    </script>
@endsection
