<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Siswa2;
use App\Models\Detailsiswa;
use App\Models\Tipekelas;
use App\Models\Kota;
use App\Models\Angkatan;
use App\Models\Kelas;
use App\Models\Univ;
use App\Models\User;
use App\Models\Rating;
use App\Models\Pilih;
use App\Exports\SiswaExport;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Carbon\Carbon;
use DB;
use Excel;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function siswa_page()
    {
        return view('page.siswa');
    }

    public function import_siswa(Request $request)
    {
        Excel::import(new SiswaImport(), request()->file('file'));
        return redirect()->back()->with('success','data siswa berhasil diimport');
    }

    public function export_siswa(Request $request)
    {
        return Excel::download(new SiswaExport(),'data_siswa.xlsx',ExcelExcel::XLSX);
    }

    public function data_siswa(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Siswa::get();
            return DataTables::of($data)
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-sm btn-danger" data-id="'.$data->id.'" 
                data-toggle="modal" data-target="#modalhapus"><i style="margin-left: 15px" class="fa fa-trash"></i></button>';
                $btn .= ' <button class="btn btn-sm btn-info" data-id="'.$data->id.'" 
                data-siswa_name="'.$data->siswa_name.'"
                data-angkatan="'.$data->angkatan.'" data-jurusan_kelas="'.$data->jurusan_kelas.'" data-kota="'.$data->kota.'" data-nama_kelas="'.$data->nama_kelas.'"
                data-siswa_nisn="'.$data->siswa_nisn.'" data-siswa_ranking="'.$data->siswa_ranking.'" data-siswa_sertifikat="'.$data->siswa_sertifikat.'" data-siswa_nilai="'.$data->siswa_nilai.'"
                data-toggle="modal" data-target="#modaledit"><i style="margin-left: 15px" class="fa fa-edit"></i></button>';
                return $btn;
            })
            ->rawColumns(['opsi'])
            ->make(true);
        }
    }

    public function update_siswa(Request $request)
    {
        $data = Siswa::updateOrCreate(
            [
                'id'=> $request->id,
            ],
            [
                'angkatan'=> $request->angkatan,
                'nama_kelas'=> $request->nama_kelas,
                'jurusan_kelas'=> $request->jurusan_kelas,
                'kota'=> $request->kota,
                'siswa_nisn' => $request->siswa_nisn,
                'siswa_name' => $request->siswa_name,
                'siswa_ranking'=> $request->siswa_ranking,
                'siswa_sertifikat'=> $request->siswa_sertifikat,
                'siswa_nilai'=> $request->siswa_nilai,
            ]
        );

        return response()->json([
            'status'=>200,
            'message'=>'data siswa has been updated'
        ]);
    }

    public function total_siswa(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $total = Siswa::count();
            return response()->json([
                'status'=>200,
                'message'=>'display total siswa',
                'data'=>$total
            ]);
        }
    }

    public function generate_user_and_siswa()
    {
        $siswa_db = Siswa::get();
        $total_siswa = count($siswa_db); // 1099
        $pembagian = round(($total_siswa * 1) / 3); //336
        $pembagian2= round(($total_siswa * 2) / 3); //733
        $pembagian3= round(($total_siswa * 3) / 3); //1099

        $name = [];
        foreach ($siswa_db as $key => $value) {
            # code...
            $name[] = $value->nama;
        }

        $user_ada = User::whereIn('name',$name)->get();
        $name2 = [];
        foreach ($user_ada as $key => $value2) {
            # code...
            $name2[] = $value2->name;
        }
        $siswa_tanpa_user = Siswa::whereNotIn('nama', $name2)->get();
        
        // foreach ($siswa_tanpa_user as $key => $value3) {
        //     # code...
        //     $user = [
        //         'name'=>$value3->nama,
        //         'email'=>'@'.$key.$value3->nama,
        //         'pass'=>$value3->nisn,
        //         'password'=>Hash::make($value3->nisn)
        //     ];

        //     User::create($user);
        // }

        $users = DB::table('users')
            ->selectRaw('name, COUNT(*) as total')
            ->groupBy('name')
            ->orderBy('total', 'DESC')
            ->havingRaw('total > 1')
            ->get();
        // $us = User::where('name', 'Ghulam Aulia Muttaqien')->first();
        // $us->delete();

        $admin = [
            'name'=>'admin',
            'email'=>'@admin',
            'pass'=>'admin',
            'password'=>Hash::make('admin'),
            'role'=>'admin'
        ];
        User::create($admin);
        // return User::count();
        return redirect()->back();
    }

    public function hapus_siswa(Request $request)
    {
        $siswa = Siswa::find($request->id);
        if (count($siswa->pilih) > 0) {
            # code...
            Pilih::where('siswa_id', $siswa->id)->delete();
        }

        if (count($siswa->rating) > 0) {
            # code...
            Rating::where('siswa_id', $siswa->id)->delete();
        }

        $siswa->user->delete();
        $siswa->delete();

        return response()->json([
            'status'=>200,
            'message'=> 'siswa has been deleted'
        ]);
    }

    public function status_siswa(Request $request)
    {
        $periode = Siswa::select('angkatan')->orderBy('angkatan','asc')->distinct()->limit(4)->get();
        $angkatan = [];
        foreach ($periode as $key => $value) {
            # code...
            $angkatan[] = $value->angkatan;
        }

        $per = $request->periode;
        $period;
        if ($per == null) {
            # code...
            $period = date('Y');
        }else {
            # code...
            $period = $request->periode;
        }

        // semua siswa angkatan tersebut
        $data1 = DB::table('siswas')->where('angkatan',$period)
        ->select('angkatan',DB::raw('count(*) as total'))
        ->groupBy('angkatan')
        ->orderBy('angkatan','asc')->get();
        
        // semua siswa angkatan tersebut yang sudah memilih
        $data2 = Siswa::select('angkatan' ,DB::raw('count(*) as total2'))->whereHas('pilih')
        ->groupBy('angkatan')->where('angkatan',$period)
        ->orderBy('angkatan','asc')->get();

        // data lolos rating
        $data3 = Rating::where('score', '>', 84)->select('angkatan', DB::raw('count(*) as total3'))
        ->groupBy('angkatan')->where('angkatan',$period)
        ->orderBy('angkatan','asc')->get();

        // data tidak lolos rating
        $data4 = Rating::where('score', '<', 85)->select('angkatan', DB::raw('count(*) as total4'))
        ->groupBy('angkatan')->where('angkatan',$period)
        ->orderBy('angkatan','asc')->get();

        $www=[];
        $xxx=[];
        foreach ($angkatan as $key => $value) {
            # code...
            $www[]= Rating::where('angkatan', $value)->where('score','<','84')->count();
            $xxx[]= Rating::where('angkatan', $value)->where('score','>','84')->count();
            $sss[]= Siswa::where('angkatan', $value)->count();
            $zzz[]= Siswa::where('angkatan', $value)->whereHas('pilih')->count();
        }

        $x = [];
        $y = [];
        $z = [];
        $w = [];
        foreach ($data1 as $key => $a) {
            # code...
            $x[] = $a->total;
        }
        foreach ($data2 as $key => $b) {
            # code...
            $y[] = $b->total2;
        }
        foreach ($data3 as $key => $c) {
            # code...
            $z[] = $c->total3;
        }
        foreach ($data4 as $key => $d) {
            # code...
            $w[] = $d->total4;
        }
        
        return response()->json([
            'status'=>200,
            'message'=>'grafik data siswa',
            'data'=> [
                'angkatan'=>$angkatan,
                'semua_siswa'=>$sss,
                'pilih_siswa'=>$zzz,
                'lolos_rating'=>$xxx,
                'tidak_lolos_rating'=>$www,
                'periode'=>[$period]
            ]
        ]);
    }

    public function rating_siswa(Request $request)
    {
        $data = Rating::select(DB::raw('DATE_FORMAT(created_at, "%W, %d %M %y") as date'), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->orderBy('date','desc')
        ->limit(7)->get();
        
        $day = [];
        $total = [];
        foreach ($data as $key => $value) {
            # code...
            $day[]=$value->date;
            $total[]=$value->total;
        }

        $x=[];
        $y=[];
        foreach ($day as $dy => $d) {
            # code...
            $x[] = Rating::where(DB::raw('DATE_FORMAT(created_at, "%W, %d %M %y")'), $d)->where('score','<','85')->count();
            $y[] = Rating::where(DB::raw('DATE_FORMAT(created_at, "%W, %d %M %y")'), $d)->where('score','>','84')->count();
        }
        
        return response()->json([
            'status'=>200,
            'message'=>'display data rating every day',
            'data'=>[
                'day'=>$day,
                'total'=>$total,
                'lolos'=>$y,
                'tidak_lolos'=>$x
            ]
        ]);
    }
}
