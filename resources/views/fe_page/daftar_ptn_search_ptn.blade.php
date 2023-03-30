@extends('fe_layouts.master2')

{{-- @section('css')
    <link href="{{ asset('fe_assets/css/detail-page.css') }}" rel="stylesheet">
@endsection --}}

@section('content_siswa')
    <main class="bg_color" style="transform: none;">
        <div class="container margin_detail" style="transform: none;">
            <div class="row" style="transform: none;">
                
                <div class="col-lg-4">
                    <div class="box_general">
                        <div class="main_info_wrapper">
                            <div class="main_info clearfix">
                                <p style="color: blue">Menampilkan ({{ count($search_ptn) }}) daftar PTN berdasarkan Pencarian <br>
                                    <u><a href="/daftar-ptn">klik disini untuk menghapus pencarian</a></u>
                                    </p>
                                    <span style="color: blue">1. {{ $name }}</span><br>
                            </div>
                        </div>
                    </div>
                    <div class="box_general">
                        <div class="main_info_wrapper">
                            <div class="main_info clearfix">
                                <div class="user_thumb">
                                    <figure>
                                        {{-- img --}}
                                    </figure>
                                    <em class="online"><span></span>Online</em>
                                </div>
                                <div class="user_desc">
                                    <h3>{{ auth()->user()->name }}</h3>
                                    @if (auth()->user()->siswa !== null)
                                        <ul class="tags">
                                            <li><a href="#{{ auth()->user()->siswa->kota }}">Kota -
                                                    {{ auth()->user()->siswa->kota }}</a></li>
                                            <li><a href="#{{ auth()->user()->siswa->nama_kelas }}">Kelas -
                                                    {{ auth()->user()->siswa->nama_kelas }}</a></li>
                                            <li><a href="#{{ auth()->user()->siswa->jurusan_kelas }}">Jurusan -
                                                    {{ auth()->user()->siswa->jurusan_kelas }}</a></li>
                                            <li><a href="#{{ auth()->user()->siswa->angkatan }}">Angkatan -
                                                    {{ auth()->user()->siswa->angkatan }}</a></li>
                                            <li><a href="#{{ auth()->user()->siswa->siswa_ranking }}">Ranking -
                                                    {{ auth()->user()->siswa->siswa_ranking }}</a></li>
                                            <li><a href="#{{ auth()->user()->siswa->siswa_sertifikat }}">Sertifikat -
                                                    {{ auth()->user()->siswa->siswa_sertifikat }}</a></li>
                                        </ul>
                                    @else
                                        <ul class="tags">
                                            <li><a href="#0">Kota - </a></li>
                                            <li><a href="#0">Kelas - </a></li>
                                            <li><a href="#0">Jurusan - </a></li>
                                            <li><a href="#0">Angkatan - </a></li>
                                            <li><a href="#0">Ranking - </a></li>
                                            <li><a href="#0">Sertifikat - </a></li>
                                        </ul>
                                    @endif
                                </div>
                                <div class="score_in">
                                    <div class="rating">
                                        <div class="score"><span>NA<em>Nilai Akhir</em></span>
                                            @if (auth()->user()->siswa !== null)
                                                <strong>{{ auth()->user()->siswa->siswa_nilai ? auth()->user()->siswa->siswa_nilai : '-' }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /main_info_wrapper -->
                            <hr>
                            <h4>Ketentuan</h4>
                            <span>Tingkat keakuratan kalkulasi kemungkinan lolos pada PTN yang dipilih tergantung dari
                                kebenratan data.</span>
                            <div class="d-none">
                                <hr>
                                <h4>Pilihan</h4>
                                <span>1. RPL : ITATS</span>
                            </div>

                            <!-- /content_more -->
                            @if ($kelengkapan == 'not')
                                <br><a href="/my-info" class="show_hide" data-content="toggle-text">lengkapi data sebelum
                                    memilih PTN.
                                    <u>Klik disini</u>
                                </a>
                            @endif
                        </div>
                        <!-- /main_info -->
                    </div>
                    <!-- /box_general -->
                </div>

                <div class="col-lg-8">
                    <div class="box_general">
	                    <div class="tabs_detail">
	                        <ul class="nav nav-tabs" role="tablist">
	                            <li class="nav-item">
	                                <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">DAFTAR PTN</a>
	                            </li>
	                            <li class="nav-item">
	                                <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">PILIHANKU</a>
	                            </li>
	                        </ul>
	                        <div class="tab-content" role="tablist">
	                            <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
	                                <div class="card-header" role="tab" id="heading-A">
	                                    <h5>
	                                        <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
	                                            DAFTAR PTN
	                                        </a>
	                                    </h5>
	                                </div>
	                                <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
	                                    <div class="card-body info_content">
                                            @foreach ($search_ptn as $item)
                                            <div class="indent_title_in">
	                                            <i class="icon_document_alt"></i>
	                                            <h3>{{ $item->univ_name }}</h3>
	                                            <p>{{ $item->kota->kota_name }}</p>
	                                        </div>
	                                        <div class="wrapper_indent add_bottom_25">
	                                            <p>Pilih daftar jurusan yang tersedia berikut ini</p>
	                                            <h6>Jurusan</h6>
                                                @if (auth()->user()->siswa !== null)
                                                    <ul class="bullets">
                                                        @foreach ($item->jurusan as $j)
                                                            <li>
                                                                <strong>{{ $j->jurusan_name }}</strong> - 
                                                                <a type="button" id="pilih{{ $item->id }}{{ $j->id }}" style="border: none; background: transparent; color: red"
                                                                onclick="pilih({{ $item->id }},{{ $j->id }})"><u>PILIH</u></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <ul class="bullets">
                                                        @foreach ($item->jurusan as $j)
                                                            <li>
                                                                <strong>{{ $j->jurusan_name }}</strong> - 
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
	                                        </div>
	                                        <!--  End wrapper indent -->
                                            <hr>
                                            @endforeach
                                            {{ $univ->links('fe_page.pagination') }}
	                                    </div>
	                                </div>
	                            </div>
	                            <!-- /tab -->
	                            <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
	                                <div class="card-header" role="tab" id="heading-B">
	                                    <h5>
	                                        <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
	                                            PILIHANKU
	                                        </a>
	                                    </h5>
	                                </div>
	                                <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
	                                    <div class="card-body reviews">
	                                        <div id="reviews">
                                                @if (auth()->user()->siswa !== null)
                                                    @if (auth()->user()->siswa->pilih->count() > 0)
                                                        @foreach (auth()->user()->siswa->pilih as $p)
                                                        <div class="review_card">
                                                            <div class="row">
                                                                <div class="col-md-2 user_info">
                                                                    <figure>
                                                                        {{-- <img src="{{ asset('fe_assets/img/avatar4.jpg') }}" alt=""> --}}
                                                                    </figure>
                                                                    <h5>{{ auth()->user()->name }}</h5>
                                                                </div>
                                                                <div class="col-md-10 review_content">
                                                                    @php
                                                                        $rating = App\Models\Rating::where('siswa_id',auth()->user()->siswa->id)
                                                                        ->where('univ_id', $p->univ_id)->where('jurusan_id', $p->jurusan_id)->first();
                                                                    @endphp
                                                                    @if ($rating == null)
                                                                        <div class="clearfix add_bottom_15">
                                                                            <span class="rating">X.X<small>/10</small> <strong>Belum di rating</strong></span>
                                                                        </div>
                                                                        <h4>"Oops!!"</h4>
                                                                        <p>Rating belum dijalankan untuk <br>{{ $p->univ->univ_name }} - {{ $p->jurusan->jurusan_name }}</p>
                                                                        <ul>
                                                                            <li><a href="#0"><i class="icon_book"></i><span>DAFTAR SISWA</span></a></li>
                                                                            <li><a href="#0" data-toggle="modal" data-target="#modalhapus" data-id="{{ $p->id }}"><i class="icon_dislike"></i><span>HAPUS PTN</span></a></li>
                                                                            <li><a href="#0" data-toggle="modal" data-target="#mymodal" 
                                                                                data-univ_id="{{ $p->univ_id }}" data-jurusan_id="{{ $p->jurusan_id }}" data-kota="{{ $p->univ->kota->kota_name }}"
                                                                                data-univ_alumni="{{ $p->univ->univ_alumni }}"
                                                                                ><i class="icon_heart"></i> <span>PROSES RATING</span></a>
                                                                            </li>
                                                                        </ul>
                                                                    @else
                                                                        <div class="clearfix add_bottom_15">
                                                                            <span class="rating">{{ $rating->score }}<small>/10</small> <strong>Hasil Rating</strong></span>
                                                                        </div>
                                                                        @if ($rating->score > 80)
                                                                            <h4>"Great!!"</h4>
                                                                            <p>Kamu berpeluang besar untuk masuk ke PTN  <br>{{ $p->univ->univ_name }} - {{ $p->jurusan->jurusan_name }} <br>
                                                                            Jaga kualitas prestasi kamu..!!</p>
                                                                        @else
                                                                            <h4>"Sorry!!"</h4>
                                                                            <p>Kecil peluang kamu untuk diterima di PTN  <br>{{ $p->univ->univ_name }} - {{ $p->jurusan->jurusan_name }} <br>
                                                                                Tetap semangat dan jangan menyerah, sukses bisa datang dari mana saja..!!</p>
                                                                        @endif
                                                                        <ul>
                                                                            <li><a href="#0"><i class="icon_book"></i><span>DAFTAR SISWA</span></a></li>
                                                                            <li><a href="#0" data-toggle="modal" data-target="#modalhapus" data-id="{{ $p->id }}"><i class="icon_dislike"></i><span>HAPUS PTN</span></a></li>
                                                                            <li><a href="#0" data-toggle="modal" data-target="#mymodal" 
                                                                                data-univ_id="{{ $p->univ_id }}" data-jurusan_id="{{ $p->jurusan_id }}" data-kota="{{ $p->univ->kota->kota_name }}"
                                                                                data-univ_alumni="{{ $p->univ->univ_alumni }}"
                                                                                ><i class="icon_heart"></i> <span>PROSES RATING</span></a>
                                                                            </li>
                                                                        </ul>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!-- /row -->
                                                        </div>
                                                        @endforeach
                                                        <span>Apabila sudah memilih PTN namun daftar pilihanmu belum tampil disini. <br>
                                                            Klik tombol berikut untuk melihat update PTN yang sudah dipilih</span><br>
                                                            <hr>
                                                        <a href="/daftar-ptn" class="btn_1 btn_scroll">REFRESH</a>
                                                    @else
                                                        <p>Pilih PTN yang anda minati terlebih dahulu atau lakukan refresh pada halaman ini untuk menampilkan data PTN pilihan anda</p>
                                                        <a href="/daftar-ptn" class="btn_1 btn_scroll">REFRESH</a>
                                                    @endif
                                                @else
                                                <div class="review_card">
                                                    Update Data Anda Terlebih Dahulu
                                                </div>
                                                @endif
                                                
	                                            
	                                            <!-- /review_card -->
	                                        </div>
	                                        <!-- /reviews -->
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- /tab-content -->
	                    </div>
	                    <!-- /tabs_detail -->
	                </div>
                </div>
                {{-- <!-- /col -->
                <div class="col-lg-4" id="sidebar_fixed"
                    style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                    <!-- /box_booking -->
                </div> --}}
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
