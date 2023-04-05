@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar User</h1>
            <a href="#" data-toggle="modal" data-target="#modalimport"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-upload fa-sm text-white-50"></i> Import User ".xlsx"</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total USER</div>
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
            <div class="col-xl-12 col-md-12" style="margin-bottom:20px">
                <button class="btn btn-sm btn-primary" data-toggle="modal" 
                data-target="#modaladd"><i class="fa fa-plus"></i> Add New User</button>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="table-responsive">
                    <table id="example" class="display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Akses</th>
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
            <form action="/admin-import-user" enctype="multipart/form-data" method="POST">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import data user?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <code>user yang diimport pada fungsi ini tidak memiliki data siswa <br>
                        siswa harus mengisi datanya sendiri melalui tampilan front end masing-masing</code>
                        <hr>
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


    <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formadd" enctype="multipart/form-data" method="POST">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <code>User yang ditambahkan pada fungsi ini tidak memiliki tabel siswa, <br>
                        siswa harus mengisikan data lengkapnya sendiri pada halaman front end</code>
                        <hr>
                        <div class="form-group">
                            <input type="hidden" class="rorm-control" name="id" id="id">
                            <input type="text" class="form-control" placeholder="username" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pass" id="pass" required placeholder="password">
                        </div>
                        <div class="form-group">
                            <select name="role" class="form-control" id="role">
                                <option value="admin">Admin</option>
                                <option value="siswa">Siswa</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" id="btnadd" class="btn btn-sm btn-primary" value="SUBMIT">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script>
        $(document).ready(function() {
            table_univ();
            total();
        });

        function table_univ() {
            var table = $('#example').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: "/admin-daftar-user",
                columns: [{
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                   
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'pass',
                        name: 'pass'
                    },
                    {
                        data: 'role',
                        name: 'role'
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
                url: '/total-user',
                success: function(response) {
                    $('#total').html(response.total);
                    console.log(response.total);
                }
            });
        }

        $('#formadd').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/admin-add-user",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnadd').attr('disabled', 'disabled');
                        $('#btnadd').val('Process...');
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            var table = $('#example').DataTable();
                            table.ajax.reload();
                            $('#modaladd').modal('hide');
                            $("#formadd")[0].reset();
                            $('#btnadd').val('SUBMIT');
                            $('#btnadd').attr('disabled', false);
                            toastr.success(response.message);
                            total();
                        } else {
                            $('#btnadd').val('SUBMIT!');
                            $('#btnadd').attr('disabled', false);
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

            $('#modalhapus').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            })

            $('#modaladd').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var pass = button.data('pass')
            var role = button.data('role')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #pass').val(pass);
            modal.find('.modal-body #role').val(role);
            modal.find('.modal-body #name').val(name);
            })

            $('#formhapus').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/admin-hapus-user",
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
