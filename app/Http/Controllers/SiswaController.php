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
use App\Exports\SiswaExport;
use Illuminate\Support\Facades\Hash;
use DataTables;
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
            $data = Siswa::with(['tipekelas','kelas','angkatan'])->get();
            return DataTables::of($data)
            ->addColumn('jurusan', function($data){
                if ($data->tipekelas) {
                    # code...
                    return $data->detailsiswa->tipekelas->tipekelas_name;
                }
                return '-';
            })
            ->addColumn('kelas', function($data){
                if ($data->kelas) {
                    # code...
                    return $data->detailsiswa->kelas->kelas_name;
                }
                return '-';
            })
            ->addColumn('angkatan', function($data){
                if ($data->angkatan) {
                    # code...
                    return $data->detailsiswa->angkatan->angkatan_name;
                }
                return '-';
            })
            ->addColumn('kota', function($data){
                if ($data->kota) {
                    # code...
                    return $data->detailsiswa->kota->kota_name;
                }
                return '-';
            })
            
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-sm btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldel"><i style="margin-left: 15px" class="fa fa-trash"></i></button>';
                $btn .= ' <button class="btn btn-sm btn-info" data-id="'.$data->id.'" data-toggle="modal" data-target="#modaledit"><i style="margin-left: 15px" class="fa fa-edit"></i></button>';
                return $btn;
            })
            ->rawColumns(['angkatan','opsi','kelas','jurusan','kota','siswa_ranking','siswa_sertifikat','siswa_nilai'])
            ->make(true);
        }
    }

    public function update_siswa(Request $request)
    {
        $siswa = Siswa::where('id', $request->id)->first();
        $user  = User::where('name', $siswa->nama)->where('pass',$siswa->nisn)->first();
        
        $tipekelas = Tipekelas::where('tipekelas_name', $request->jurusan)->first();
        if ($tipekelas == null) {
            # code...
            $jurusan = [
                'tipekelas_name'=> $request->jurusan
            ];
            $jurusan = Tipekelas::create($jurusan);
            $tipekelas = $jurusan;
        }

        $kota = Kota::where('kota_name', $request->kota)->first();
        if ($kota == null) {
            # code...
            $k = [
                'provinsi_id'=> null,
                'kota_name'=>$request->kota,
            ];
            $k = Kota::create($k);
            $kota = $k;
        }

        $data = Siswa::updateOrCreate(
            [
                'id'=> $request->id,
            ],
            [
                'user_id' => $user->id,
                'tipekelas_id'=> $tipekelas->id,
                'kota_id'=> $kota->id,
                'siswa_nisn' => $request->siswa_nisn,
                'siswa_name' => $request->siswa_name,
                'siswa_ranking'=> $request->ranking,
                'siswa_sertifikat'=> $request->sertifikat,
                'siswa_nilai'=> $request->nilai,
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
}
