<?php

namespace App\Http\Controllers;
use DataTables;
use App\Models\Siswa;
use App\Models\Link;
use App\Models\Notif;
use Excel;
use Auth;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Carbon\Carbon;
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


    public function notif_index(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Notif::orderBy('id','desc')->get();
            return DataTables::of($data)
            ->addColumn('status_notif', function($data) {
                if ($data->status == 'unread') {
                    # code...
                    return '<span class="text-xs font-weight-bold text-info text-uppercase mb-1">UNREAD</span>';
                }else {
                    # code...
                    return '<span class="text-xs font-weight-bold text-info text-uppercase mb-1">READ BY - '.$data->user->name.'</span>';
                }
            })
            ->addColumn('tanggal', function($data){
                return Carbon::parse($data->updated_at)->format('d/M/Y - H:i:s');
            })
            ->rawColumns(['status_notif','tanggal'])
            ->make(true);
        }
            
        return view('page.notif');
    }

    public function total_notif(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $total = Notif::where('status','unread')->count();
            $data  = Notif::where('status','unread')->orderBy('id','desc')->limit(3)->get();
            $last  = Notif::latest()->first();

            $tanggal = [];
            foreach ($data as $key => $value) {
                $tanggal[] = Carbon::parse($value->updated_at)->format('d/M/Y - H:i:s');
            }

            return response()->json([
                'status'=>200,
                'message'=>'menampilkan total notif & data notif',
                'data' => $data,
                'total' => $total,
                'last' => $last->pesan,
                'tanggal'=> $tanggal,
            ]);

        }
    }

    public function mark_read_notif(Request $request)
    {
        if ($request->ajax()) {
            # code...
            Notif::where('status','unread')->update([
                'status'=>'read',
                'user_id'=>Auth::id()
            ]);
            
            $total = Notif::where('status','unread')->count();
            $data  = Notif::where('status','unread')->orderBy('id','desc')->limit(3)->get();

            $tanggal = [];
            foreach ($data as $key => $value) {
                $tanggal[] = Carbon::parse($value->updated_at)->format('d/M/Y - H:i:s');
            }

            return response()->json([
                'status'=>200,
                'message'=>'Mark as read all unread notification',
                'data' => $data,
                'total' => $total,
                'tanggal'=> $tanggal,
            ]);

        }
    }
}
