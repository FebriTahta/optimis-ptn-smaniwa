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
                        <form method="post" action="assets/register.php" id="register">
                            <h6>Personal data</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name and Last Name"
                                            name="name_register" id="name_register" value="{{ $siswa->siswa_name }}">
                                    </div>
                                </div>
                            </div>
                        
                            <!-- /row -->
                            <h6>Detail info</h6>
                            <!-- /row -->
                            <div class="row add_bottom_15">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Kelas" name="kelas"
                                            id="kelas" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Angkatan" name="angkatan"
                                            id="angkatan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Jurusan" name="jurusan"
                                            id="jurusan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Ranking" name="rangking"
                                            id="ranking" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Nilai Akhir" name="nilai_akhir"
                                            id="nilai_akhir" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Sertifikat Ynag Dimiliki" name="sertifikat"
                                            id="sertifikat" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Kota" name="kota"
                                            id="city_register" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="text-center form-group"><input type="submit" class="btn_1" value="Submit"
                                    id="submit-register"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /container -->
    </div>
@endsection
