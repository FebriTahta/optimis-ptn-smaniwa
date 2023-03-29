@extends('fe_layouts.master')

@section('content')
    <div class="bg_gray pattern_mail" id="submit">
        <div class="container margin_60_40">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="box_general padding">
                        <div class="text-center add_bottom_15">
                            <h4>Please fill the form below</h4>
                            <p>Lengkapi data anda dengan sebenar benarnya untuk meningkatkan nilai akurasi kemungkinan lolos PTN</p>
                        </div>
                        <div id="message-register"></div>
                        @if (auth()->user()->siswa == null)
                        <form method="post" id="formadd">@csrf
                            <h6>Personal data</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name and Last Name"
                                            name="siswa_name" id="name_register" value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- /row -->
                            <h6>Detail info</h6>
                            <!-- /row -->
                            <div class="row add_bottom_15">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Kelas : romawi</small>
                                        <input type="text" class="form-control" style="text-transform: uppercase" placeholder="XII" name="nama_kelas"
                                            id="kelas" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Angkatan : tahun lulus</small>
                                        <input type="number" class="form-control" style="text-transform: uppercase" placeholder="2022" name="angkatan"
                                            id="angkatan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Jurusan : IPA / IPS / RPL / JARINGAN</small>
                                        <input type="text" class="form-control" style="text-transform: uppercase" placeholder="Jurusan" name="jurusan_kelas"
                                            id="jurusan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Ranking : angka 1 - n</small>
                                        <input type="number" class="form-control" style="text-transform: uppercase" placeholder="Ranking" name="siswa_ranking"
                                            id="ranking" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Nilai Akhir : angka nilai akhir</small>
                                        <input type="number" class="form-control" style="text-transform: uppercase" placeholder="Nilai Akhir" name="siswa_nilai"
                                            id="nilai_akhir" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Sertifikat : angka 0 - n</small>
                                        <input type="number" class="form-control" style="text-transform: uppercase" placeholder="Sertifikat Ynag Dimiliki" name="siswa_sertifikat"
                                            id="sertifikat" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <small>Kota : tidak disingkat</small>
                                        <input type="text" class="form-control" style="text-transform: uppercase" placeholder="Kota" name="kota"
                                            id="city_register" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="text-center form-group"><input type="submit" class="btn_1" value="Submit"
                                    id="btnadd"></div>
                        </form>
                        @else
                        <form method="post" id="formadd">@csrf
                            <h6>Personal data</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name and Last Name"
                                            name="siswa_name" id="name_register" value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- /row -->
                            <h6>Detail info</h6>
                            <!-- /row -->
                            <div class="row add_bottom_15">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Kelas : romawi</small>
                                        <input type="text" class="form-control" style="text-transform: uppercase" placeholder="XII" name="nama_kelas"
                                            id="kelas" value="{{ auth()->user()->siswa->nama_kelas }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Angkatan : tahun lulus</small>
                                        <input type="number" class="form-control" style="text-transform: uppercase" placeholder="2022" name="angkatan"
                                            id="angkatan" required value="{{ auth()->user()->siswa->angkatan }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Jurusan : IPA / IPS / RPL / JARINGAN</small>
                                        <input type="text" class="form-control" style="text-transform: uppercase" placeholder="Jurusan" name="jurusan_kelas"
                                            id="jurusan" value="{{ auth()->user()->siswa->jurusan_kelas }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Ranking : angka 1 - n</small>
                                        <input type="number" class="form-control" style="text-transform: uppercase" placeholder="Ranking" name="siswa_ranking"
                                            id="ranking" value="{{ auth()->user()->siswa->siswa_ranking }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Nilai Akhir : angka nilai akhir</small>
                                        <input type="number" class="form-control" style="text-transform: uppercase" placeholder="Nilai Akhir" name="siswa_nilai"
                                            id="nilai_akhir" value="{{ auth()->user()->siswa->siswa_nilai }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small>Sertifikat : angka 0 - n</small>
                                        <input type="number" class="form-control" style="text-transform: uppercase" placeholder="Sertifikat Ynag Dimiliki" name="siswa_sertifikat"
                                            id="sertifikat" value="{{ auth()->user()->siswa->siswa_sertifikat }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <small>Kota : tidak disingkat</small>
                                        <input type="text" class="form-control" style="text-transform: uppercase" placeholder="Kota" name="kota"
                                            id="city_register" value="{{ auth()->user()->siswa->kota }}" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="text-center form-group"><input type="submit" class="btn_1" value="Submit"
                                    id="btnadd"></div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /container -->
    </div>
@endsection

@section('fe_script')
    <script>
        $('#formadd').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/submit-data-siswa",
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
                            // $("#formadd")[0].reset();
                            $('#btnadd').val('SUBMIT');
                            $('#btnadd').attr('disabled', false);
                            toastr.success(response.message);
                            // swal({
                            //     title: "SUCCESS!",
                            //     text: response.message,
                            //     type: "success"
                            // }).then(okay => {
                            //     if (okay) {
                            //         window.location.href = "/backend-event";
                            //     }
                            // });
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
    </script>
@endsection


