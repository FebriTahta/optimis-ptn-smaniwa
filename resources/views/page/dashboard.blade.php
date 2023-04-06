@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total SISWA</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span
                                                id="total"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total PTN</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span
                                                id="total"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-university fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">SISWA PTN BELUM RATING
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span
                                                id="total"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-info fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">SISWA RATING PTN</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span
                                                id="total"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-md-12 mb-4 d-none">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-header">
                        #NOTE
                    </div>
                    <div class="card-body">
                        Ketentuan Penilaian Rating :
                        <ol>
                            <li>
                                <div class="row">
                                    <div class="col-md-6">Akreditasi</div>
                                    <div class="col-md-3">A</div>
                                    <div class="col-md-3">10%</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-6">KKM Sekolah</div>
                                    <div class="col-md-3">75</div>
                                    <div class="col-md-3">10%</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-6">Nilai Siswa</div>
                                    <div class="col-md-3">75-100</div>
                                    <div class="col-md-3">10-25%</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-6">Alumni PTN</div>
                                    <div class="col-md-3">1-n</div>
                                    <div class="col-md-3">5-15%</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-6">Ranking</div>
                                    <div class="col-md-3">1-n</div>
                                    <div class="col-md-3">5-10%</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-6">Sertifikat</div>
                                    <div class="col-md-3">1-n</div>
                                    <div class="col-md-3">7-20%</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-6">Domisili PTN</div>
                                    <div class="col-md-3">L-D</div>
                                    <div class="col-md-3">5-10%</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-6">Linjur</div>
                                    <div class="col-md-3">Y-N</div>
                                    <div class="col-md-3">5-10%</div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <style>
                .highcharts-figure,
                .highcharts-data-table table {
                    min-width: 310px;
                    max-width: 800px;
                    margin: 1em auto;
                }

                #container-chart {
                    height: 310px;
                }

                .highcharts-data-table table {
                    font-family: Verdana, sans-serif;
                    border-collapse: collapse;
                    border: 1px solid #ebebeb;
                    margin: 10px auto;
                    text-align: center;
                    width: 100%;
                    max-width: 500px;
                }

                .highcharts-data-table caption {
                    padding: 1em 0;
                    font-size: 1.2em;
                    color: #555;
                }

                .highcharts-data-table th {
                    font-weight: 600;
                    /* padding: 0.5em; */
                }

                .highcharts-data-table td,
                .highcharts-data-table th,
                .highcharts-data-table caption {
                    /* padding: 0.5em; */
                }

                .highcharts-data-table thead tr,
                .highcharts-data-table tr:nth-child(even) {
                    background: #f8f8f8;
                }

                .highcharts-data-table tr:hover {
                    background: #f1f7ff;
                }
            </style>
            <div class="col-xl-5 col-md-12 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-header">
                        #LIVE Status Siswa Per Periode Angkatan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <figure class="highcharts-figure">
                                <div id="container-chart"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-md-12 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-header">
                        #LIVE Status Rating & Probabilitas Masuk PTN
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <figure class="highcharts-figure">
                                <div id="container-chart2"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            chart();
            chart2();
        });

        function chart2() {
            $.ajax({
                type: 'GET',
                url: '/admin-rating-siswa',
                success: function(response) {
                    Highcharts.chart('container-chart2', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Grafik Status Rating Per Hari (7)'
                        },
                        xAxis: {
                            categories: response.data.day
                        },
                        yAxis: {
                            title: {
                                text: 'TOTAL RATING'
                            }
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: false
                            }
                        },
                        series: [{
                            name: 'LOLOS RATING',
                            data: response.data.lolos
                        }, {
                            name: 'TIDAK LOLOS RATING',
                            data: response.data.tidak_lolos
                        }]
                    });
                }
            });
            // Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature

        }

        function chart() {
            $.ajax({
                type: 'GET',
                url: '/admin-status-siswa',
                success: function(response) {
                    Highcharts.chart('container-chart', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Grafik Siswa Per Periode'
                        },
                        xAxis: {
                            categories: response.data.angkatan,
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'TOTAL'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                                name: 'Lolos Rating',
                                data: response.data.lolos_rating

                            }, {
                                name: 'Tidak Lolos Rating',
                                data: response.data.tidak_lolos_rating

                            },
                            {
                                name: 'Seluruh Siswa',
                                data: response.data.semua_siswa

                            }, {
                                name: 'Siswa Memilih',
                                data: response.data.pilih_siswa

                            },
                        ]
                    });
                }
            });
        }
    </script>
@endsection
