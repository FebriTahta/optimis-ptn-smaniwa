<?php

namespace App\Http\Controllers;
use App\Models\Univ;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;

class FEController extends Controller
{
    public function landing_page(Request $request)
    {
        $univ = Univ::get();
        $jurusan = Jurusan::get();
        $bagian1 = round($jurusan->count() / 2);
        $bagian2 = $jurusan->count() - $bagian1;

        $jurusan_id  = [];
        $jurusan_id2 = [];
        foreach ($jurusan as $key => $value) {
            # code...
            if ($key >= $bagian1) {
                # code...
                $jurusan_id[] = $value->id;
            }
        }

        foreach ($jurusan as $key2 => $value2) {
            # code...
            if ($key2 <= $bagian2) {
                # code...
                $jurusan_id2[] = $value2->id;
            }
        }
        
        $jurusan_ = Jurusan::whereIn('id',$jurusan_id)->get();
        $jurusan_2= Jurusan::whereIn('id',$jurusan_id2)->get();
        return view('fe_page.landing',compact('univ','jurusan','jurusan_','jurusan_2'));
    }

    public function daftar_ptn()
    {
        $univ = Univ::get();
        $jurusan = Jurusan::get();
        $bagian1 = round($jurusan->count() / 2);
        $bagian2 = $jurusan->count() - $bagian1;

        $jurusan_id  = [];
        $jurusan_id2 = [];
        foreach ($jurusan as $key => $value) {
            # code...
            if ($key >= $bagian1) {
                # code...
                $jurusan_id[] = $value->id;
            }
        }

        foreach ($jurusan as $key2 => $value2) {
            # code...
            if ($key2 <= $bagian2) {
                # code...
                $jurusan_id2[] = $value2->id;
            }
        }
        
        $jurusan_ = Jurusan::whereIn('id',$jurusan_id)->get();
        $jurusan_2= Jurusan::whereIn('id',$jurusan_id2)->get();

        $kelengkapan;
        
        if (auth()->user()->siswa == null || auth()->user()->siswa->angkatan == null ||
        auth()->user()->siswa->nama_kelas == null || auth()->user()->siswa->jurusan_kelas == null
        || auth()->user()->siswa->kota == null || auth()->user()->siswa->siswa_ranking == null || 
        auth()->user()->siswa->siswa_sertifikat == null || auth()->user()->siswa->siswa_nilai == null) {
            # code...
            $kelengkapan = 'not';
        }else {
            # code...
            $kelengkapan = 'yes';
        }

        return view('fe_page.daftar_ptn',compact('univ','jurusan','jurusan_','jurusan_2','kelengkapan'));
    }

    public function my_info(Request $request)
    {
        $siswa = auth()->user()->siswa;
        return view('fe_page.my_info',compact('siswa'));
    }

    public function submit_data_siswa(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'angkatan'      => 'required|max:10',
                'nama_kelas'    => 'required|',
                'jurusan_kelas' => 'required|',
                'kota'          => 'required|',
                'siswa_name'    => 'required|',
                'siswa_ranking' => 'required|',
                'siswa_sertifikat'     => 'required|',
                'siswa_nilai'   => 'required|',
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'status' => 400,
                    'message'  => $validator->messages().'',
                ]);
    
            }else {
                $data = Siswa::updateOrCreate(
                    [
                        'user_id'       => auth()->user()->id,
                    ],
                    [
                        'user_id'       => auth()->user()->id,
                        'angkatan'      =>$request->angkatan,
                        'nama_kelas'    =>strtoupper($request->nama_kelas),
                        'jurusan_kelas' =>strtoupper($request->jurusan_kelas),
                        'kota'          =>strtoupper($request->kota),
                        'siswa_name'    => auth()->user()->name,
                        'siswa_nisn'    => auth()->user()->pass,
                        'siswa_ranking' =>$request->siswa_ranking,
                        'siswa_sertifikat' =>$request->siswa_sertifikat,
                        'siswa_nilai'   =>$request->siswa_nilai,
                    ]
                );

                return response()->json(
                    [
                        'status'=>200,
                        'message'=>['Data siswa berhasil di update']
                    ]
                );
            }
        }
    }

}
