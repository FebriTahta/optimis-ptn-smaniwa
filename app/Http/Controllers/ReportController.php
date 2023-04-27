<?php

namespace App\Http\Controllers;
use DataTables;
use App\Models\Siswa;
use App\Models\Link;
use Excel;
use Auth;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report_index(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Siswa::get();
            return DataTables::of($data)
            ->addColumn('pilihan_1', function($data) {
                $first = [];
                if ($data->pilih->count() > 0) {
                    # code...
                    if ($data->rating->count() > 0) {
                        # code...
                        foreach ($data->rating as $key => $value) {
                            # code...
                            $first[] = $value->jurusan->jurusan_name.'-'.$value->univ->univ_name. ' "'.$value->score.'"';
                        }
                        return $first[0];
                    }else {
                        # code...
                        if ($data->pilih->count() < 2) {
                            # code...
                            return 'BELUM MEMILIH';
                        }else {
                            # code...
                            return 'BELUM RATING' ;
                        }
                    }

                }else {
                    # code...
                    return 'BELUM MEMILIH';
                }
            })
            ->addColumn('pilihan_2', function($data) {
                $last = [];
                if ($data->pilih->count() > 0) {
                    # code...
                    if ($data->rating->count() > 1) {
                        # code...
                        foreach ($data->rating as $key => $value) {
                            # code...
                            $last[] = $value->jurusan->jurusan_name.'-'.$value->univ->univ_name. ' "'.$value->score.'"';
                        }
                        return $last[1];
                    }else {
                        # code...
                        if ($data->pilih->count() < 2) {
                            # code...
                            return 'BELUM MEMILIH';
                        }else {
                            # code...
                            return 'BELUM RATING' ;
                        }
                        
                    }

                }else {
                    # code...
                    return 'BELUM MEMILIH';
                }
            })
            ->addColumn('status', function($data) {
                if ($data->pilih->count() > 0) {
                    # code...
                    if ($data->rating->count() > 1) {
                        # code...
                        return 'SELESAI RATING';
                    }elseif($data->rating->count() == 1) {
                        # code...
                        return 'RATING SEBAGIAN';
                    }else {
                        # code...
                        return 'BELUM RATING';
                    }

                }else {
                    # code...
                    return 'BELUM MEMILIH';
                }
            })
            ->addColumn('kelas', function($data) {
                
                return $data->nama_kelas.' '.$data->jurusan_kelas.' '.$data->angkatan;
            })
            ->rawColumns(['status','pilihan_1','pilihan_2','kelas'])
            ->make(true);
        }
        return view('page.report');
    }

    public function report_filter($angkatan,Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Siswa::where('angkatan',$angkatan)->get();
            return DataTables::of($data)
            ->addColumn('pilihan_1', function($data) {
                $first = [];
                if ($data->pilih->count() > 0) {
                    # code...
                    if ($data->rating->count() > 0) {
                        # code...
                        foreach ($data->rating as $key => $value) {
                            # code...
                            $first[] = $value->jurusan->jurusan_name.'-'.$value->univ->univ_name. ' "'.$value->score.'"';
                        }
                        return $first[0];
                    }else {
                        # code...
                        $first = 'BELUM RATING';
                        return $first;
                    }
                }else {
                    # code...
                    $first = 'BELUM MEMILIH';
                    return $first;
                }

            })
            ->addColumn('pilihan_2', function($data) {
                $last = [];
                if ($data->pilih->count() > 0) {
                    # code...
                    if ($data->rating->count() > 1) {
                        # code...
                        foreach ($data->rating as $key => $value) {
                            # code...
                            $last[] = $value->jurusan->jurusan_name.'-'.$value->univ->univ_name. ' "'.$value->score.'"';
                        }
                        return $last[1];
                    }else {
                        # code...
                        if ($data->pilih->count() < 2) {
                            # code...
                            return 'BELUM MEMILIH';
                        }else {
                            # code...
                            return 'BELUM RATING' ;
                        }
                    }

                }else {
                    # code...
                    $last = 'BELUM MEMILIH';
                    return $last;
                }
                
            })
            ->addColumn('status', function($data) {
                if ($data->pilih->count() > 0) {
                    # code...
                    if ($data->rating->count() > 1) {
                        # code...
                        return 'SELESAI RATING';
                    }elseif($data->rating->count() == 1) {
                        # code...
                        return 'RATING SEBAGIAN';
                    }else {
                        # code...
                        return 'BELUM RATING';
                    }

                }else {
                    # code...
                    return 'BELUM MEMILIH';
                }
            })
            ->addColumn('kelas', function($data) {
                
                return $data->nama_kelas.' '.$data->jurusan_kelas.' '.$data->angkatan;
            })
            ->rawColumns(['status','pilihan_1','pilihan_2','kelas'])
            ->make(true);
        }
    }

    public function export_report($angkatan, Request $request)
    {
        return Excel::download(new ReportExport($angkatan),'data_rating_siswa.xlsx',ExcelExcel::XLSX);
    }

    public function matikan_notif()
    {
        $data = Auth::user()->update([
            'web_token'=> null
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'NOTIFIKASI DIMATIKAN'
        ]);
    }

    public function update_link(Request $request)
    {
        $data = Link::updateOrCreate(
            [
                'id'=>$request->link_id
            ],
            [
                'link'=>$request->link
            ]
        );

        return response()->json([
            'status'=>200,
            'message'=>'link telah diperbarui'
        ]);
    }

    public function get_link()
    {
        $data = Link::first();
        if ($data==null) {
            # code...
            return response()->json([
                'status'=>400,
                'message'=>'Data link belum tersedia. pastikan link ditulis tanpa www / https'
            ]);
        }else {
            # code...
            if ($data->link !== null && $data->link !== "") {
                # code...
                return response()->json([
                    'status'=>200,
                    'message'=>'Data link sudah tersedia. pastikan link ditulis tanpa www / https',
                    'link_id'=>$data->id,
                    'link'=>$data->link
                ]);
            }else {
                # code...
                return response()->json([
                    'status'=>400,
                    'message'=>'Data link belum tersedia. pastikan link ditulis tanpa www / https'
                ]);
            }
        }
    }
}
