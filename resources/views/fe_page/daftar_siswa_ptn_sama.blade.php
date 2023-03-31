@extends('fe_layouts.master2')

{{-- @section('css')
    <link href="{{ asset('fe_assets/css/detail-page.css') }}" rel="stylesheet">
@endsection --}}

@section('content_siswa')
    <main class="bg_color" style="transform: none;">
        <div class="container margin_detail" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="box_general">
	                    <div class="tabs_detail">
	                        <ul class="nav nav-tabs" role="tablist">
	                            <li class="nav-item">
	                                <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">DAFTAR SISWA ANGKATAN : {{ auth()->user()->siswa->angkatan }}</a>
	                            </li>
	                        </ul>
	                        <div class="tab-content" role="tablist">
	                            <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
	                                <div class="card-header" role="tab" id="heading-A">
	                                    <h5>
	                                        <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
	                                            DAFTAR SISWA ANGKATAN : {{ auth()->user()->siswa->angkatan }}
	                                        </a>
	                                    </h5>
	                                </div>
	                                <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
	                                    <div class="card-body info_content">
                                            <p>DAFTAR SISWA YANG MENGAMBIL PTN : <br> {{ $ptn_ini->univ_name }} - {{ $jurusan_ini->jurusan_name }}</p>
                                            <hr>
                                            <div class="services_list clearfix">
                                                <ul>
                                                    @foreach ($rating as $key=> $item)
                                                       
                                                        <li
                                                            @if ($item->siswa_id == auth()->user()->siswa->id)
                                                                style="color: blue"
                                                            @endif
                                                        >
                                                            @if (strlen($key+1) < 2)
                                                                0{{ $key+1 }}
                                                            @else 
                                                                {{ $key+1 }}
                                                            @endif
                                                            . {{ $item->siswa->siswa_name }} ({{ $item->siswa->nama_kelas }} - {{ $item->jurusan }})
                                                            <br>NA : {{ $item->siswa->siswa_nilai }} / RATING : {{ $item->score }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            {{ $rating->links('fe_page.pagination') }}
	                                    </div>
	                                </div>
	                            </div>
	                            <!-- /tab -->
	                        </div>
	                        <!-- /tab-content -->
	                    </div>
	                    <!-- /tabs_detail -->
	                </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>

    <div class="modal fade" id="mymodal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <form id="form_rating">@csrf
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                    <p>Apakah Jurusan yang kamu pilih pada PTN termasuk Lintas Jurusan atau tidak dengan jurusan
                        pendidikanmu di SMA/SMK ?
                    </p>
                    <input type="hidden" name="univ_id" id="univ_id" class="form-control">
                    <input type="hidden" name="jurusan_id" id="jurusan_id" class="form-control">
                    <input type="hidden" name="kota" id="kota" class="form-control">
                    <input type="hidden" name="univ_alumni" id="univ_alumni" class="form-control">
                    <input type="radio" name="linjur" value="linjur" required> <label>Lintas Jurusan (menyimpang dari jurusan SMA/SMK)</label><br>
                    <input type="radio" name="linjur" value="tidak_linjur" required> <label>Tidak Lintas Jurusan</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn_1 btn_scroll" value="Do Rating" id="btn_rating">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalhapus" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <form id="form_hapus">@csrf
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                    <p>Yakin akan meghapus PTN pilihan anda ? <br>
                       Semoga PTN yang lain menampilkan hasil rating seperti yang kamu inginkan
                    </p>
                    <input type="hidden" class="form-control" name="id" id="id" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn_1 btn_scroll" value="Hapus PTN" id="btn_hapus">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('fe_script')
    <script>
        $(document).ready(function() {
            my_choice();
        });

        function my_choice() {
            $.ajax({
                type: 'GET',
                url: '/my-choice',
                success: function(response) {
                    if (response.status == 200) {
                        toastr.success(response.message);
                        $.each(response.data, function(key, dt) {
                            if (document.getElementById("pilih"+dt.univ_id+dt.jurusan_id)) {
                                $('#pilih'+dt.univ_id+dt.jurusan_id).html('TELAH DIPILIH');
                                document.getElementById("pilih"+dt.univ_id+dt.jurusan_id).style.color = "blue";
                            }
                        });
                    }else{
                        toastr.error(response.message);
                    }
                }
            });
        }

        $('#mymodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var univ_id = button.data('univ_id')
            var jurusan_id = button.data('jurusan_id')
            var kota = button.data('kota')
            var univ_alumni = button.data('univ_alumni')
            var modal = $(this)
            modal.find('.modal-body #univ_id').val(univ_id);
            modal.find('.modal-body #jurusan_id').val(jurusan_id);
            modal.find('.modal-body #kota').val(kota);
            modal.find('.modal-body #univ_alumni').val(univ_alumni);
        })

        $('#modalhapus').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })

        function pilih(univ_id,jurusan_id) {
            $.ajax({
                type: 'POST',
                url: '/pilih-ptn',
                data: {
                    univ_id: univ_id,
                    jurusan_id: jurusan_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status == 200) {
                        toastr.success(response.message);
                        $('#'+response.data).html('TELAH DIPILIH');
                            document.getElementById(response.data).style.color = "blue";
                    }else{
                        toastr.error(response.message);
                    }
                }
            });
        }

        $('#form_rating').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/proses-rating",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btn_rating').attr('disabled', 'disabled');
                    $('#btn_rating').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#form_rating")[0].reset();
                        $('#btn_rating').val('Do Rating');
                        $('#btn_rating').attr('disabled', false);
                        toastr.success(response.message);
                        window.location.href = "/daftar-ptn";

                    } else {
                        $('#btn_rating').val('Do Rating');
                        $('#btn_rating').attr('disabled', false);
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

        $('#form_hapus').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/hapus-ptn-pilihan",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btn_hapus').attr('disabled', 'disabled');
                    $('#btn_hapus').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#form_hapus")[0].reset();
                        $('#btn_hapus').val('Hapus PTN');
                        $('#btn_hapus').attr('disabled', false);
                        toastr.success(response.message);
                        window.location.href = "/daftar-ptn";

                    } else {
                        $('#btn_hapus').val('Hapus PTN');
                        $('#btn_hapus').attr('disabled', false);
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

        $('#sort').on('change', function () {
            var enc = btoa(this.value);
            window.location.href = "/daftar-ptn-filter-ptn/" + enc;
        })

        function GetSelected() {
            //Create an Array.
            var selected = new Array();

            //Reference all the CheckBoxes in Table.
            var chks = document.getElementsByClassName("checkjurusan");

            // Loop and push the checked CheckBox value in Array.
            for (var i = 0; i < chks.length; i++) {
                if (chks[i].checked) {
                    selected.push(chks[i].value);
                }
            }

            //Display the selected CheckBox values.
            if (selected.length > 0) {
                var jurusan = selected.join(",");
                var enc = btoa(jurusan);
                window.location.href = "/daftar-ptn-filter-jurusan/" + enc;
                // alert("Selected values: " + selected.join(","));
            }
        }

        function search(ptn) {
            if(event.key === 'Enter') {
                var enc = btoa(ptn.value);
                window.location.href = "/daftar-ptn-search/" + enc;    
            }
        }
    </script>
@endsection
