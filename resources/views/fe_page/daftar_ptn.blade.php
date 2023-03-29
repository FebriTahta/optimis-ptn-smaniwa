@extends('fe_layouts.master2')

@section('css')
    <link href="{{ asset('fe_assets/css/detail-page.css') }}" rel="stylesheet">
@endsection

@section('content_siswa')
    <main class="bg_color" style="transform: none;">
        <div class="container margin_detail" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-lg-8">
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
                                        <div class="score"><span>NA<em>Nilai Akhir</em></span><strong>8.9</strong></div>
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
                    <div class="box_general">
                        <div class="tabs_detail">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab"
                                        role="tab" aria-selected="true">DAFTAR PTN</a>
                                </li>
                            </ul>
                            <div class="tab-content" role="tablist">
                                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel"
                                    aria-labelledby="tab-A">
                                    <div class="card-header" role="tab" id="heading-A">
                                        <h5>
                                            <a class="collapsed" data-toggle="collapse" href="#collapse-A"
                                                aria-expanded="false" aria-controls="collapse-A">
                                                DAFTAR PTN
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A"
                                        style="">
                                        <div class="card-body info_content">
                                            @foreach ($univ as $item)
                                                <div class="indent_title_in">
                                                    <i class="icon_document_alt"></i>
                                                    <h3>{{ $item->univ_name }}</h3>
                                                    <p>{{ $item->kota->kota_name }}, {{ $item->jurusan->count() }} JURUSAN
                                                    </p>
                                                </div>
                                                <div class="wrapper_indent">
                                                    <h6>Daftar Jurusan</h6>
                                                    <div class="services_list clearfix">
                                                        <ul>
                                                            {{-- <form id="form_pilih_ptn">@csrf --}}
                                                                @foreach ($item->jurusan as $j)
                                                                    <li>
                                                                        {{ $j->jurusan_name }}
                                                                        <strong>
                                                                            
                                                                                <input type="hidden" name="univ_id"
                                                                                    value="{{ $item->id }}">
                                                                                <input type="hidden" name="jurusan_id"
                                                                                    value="{{ $j->id }}">
                                                                                <input type="submit" id="pilihan{{ $item->id }}{{ $j->id }}" data-id="{{ $item->id }}" onclick="pilih()" value="PILIH" style="background: transparent; border: none">
                                                                                {{-- <a type="submit" 
                                                                                    style="background: transparent"><small
                                                                                        id="pilihan{{ $item->id }}{{ $j->id }}">Pilih</small></a> --}}
                                                                            
                                                                        </strong>
                                                                    </li>
                                                                @endforeach
                                                            {{-- </form> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
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
                <!-- /col -->
                <div class="col-lg-4" id="sidebar_fixed"
                    style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                    <!-- /box_booking -->


                    <div class="theiaStickySidebar"
                        style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px;">
                        <div class="box_booking mobile_fixed">
                            <div class="head">
                                <a href="#0" class="close_panel_mobile"><i class="icon_close"></i></a>
                            </div>
                            <!-- /head -->
                            <div class="main">
                                <div style="text-align: center; border-bottom: 1px">
                                    <h3>Konfirmasi</h3>
                                </div>
                                <p>1. EKONOMI : ITS</p>
                                <p>1. EKONOMI : ITS</p>
                                <!-- /type -->
                                <div class="dropdown time">
                                    {{-- <a href="#" data-toggle="dropdown">Hour <span id="selected_time"></span></a> --}}
                                </div>
                                <!-- /dropdown -->
                                <a href="booking.html" class="btn_1 full-width booking">SUBMIT</a>
                            </div>
                        </div>
                        <div class="btn_reserve_fixed"><a href="booking.html" class="btn_1 full-width booking">SUBMIT</a>
                        </div>
                        <div class="resize-sensor"
                            style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div class="resize-sensor-expand"
                                style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div
                                    style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 837px; height: 721px;">
                                </div>
                            </div>
                            <div class="resize-sensor-shrink"
                                style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div
                                    style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
@endsection

@section('fe_script')
    <script>
        $(document).ready(function() {
            // table_univ();
            // total();
        });

        function table_univ() {
            var table = $('#example').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                lengthChange: false,
                searching: false,
                info: false,
                ajax: "/data-univ",
                columns: [{
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                    {
                        data: 'univ_name',
                        name: 'univ_name'
                    },
                    {
                        data: 'total_jurusan',
                        name: 'total_jurusan'
                    },
                ]
            });
        }

        function total() {
            $.ajax({
                type: 'GET',
                url: '/total-univ',
                success: function(response) {
                    $('#total').html(response.data);
                    console.log(response.data);
                }
            });
        }

        $('#form_pilih_ptn').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/pilih-univ",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // $('#btnadd').attr('disabled', 'disabled');
                    // $('#btnadd').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        // $("#formadd")[0].reset();
                        // $('#btnadd').val('SUBMIT');
                        // $('#btnadd').attr('disabled', false);
                        toastr.success(response.message);
                        $('#'+response.data).val('telah dipilih');
                        
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

        function pilih(univ_id) {
            console.log(univ_id);
        }
    </script>
@endsection
