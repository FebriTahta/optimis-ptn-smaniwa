<?php

namespace App\Http\Controllers;
use App\Models\Univ;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Rating;
use App\Models\Pilih;
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
        $univ = Univ::paginate(10);
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

    public function pilih_univ(Request $request)
    {
        $pilihan = Pilih::where('univ_id', $request->univ_id)->where('jurusan_id',$request->jurusan_id)
        ->where('siswa_id', auth()->user()->siswa->id)->get();

        if ($pilihan->count() == 0) {
            # code...
            $siswa = Siswa::where('id', auth()->user()->siswa->id,)->first();
            if ($siswa->pilih->count() < 2) {
                # code...
                $data = Pilih::create(
                    [
                        'univ_id'=> $request->univ_id,
                        'jurusan_id'=> $request->jurusan_id,
                        'siswa_id'=> auth()->user()->siswa->id,
                    ]
                );
                return response()->json(
                    [
                        'status'=> 200,
                        'message'=> 'Berhasil menambahkan univ ke pilihan anda',
                        'data'=>'pilih'.$data->univ_id.''.$data->jurusan_id
                    ]
                );
            }else {
                # code...
                return response()->json(
                    [
                        'status'=> 400,
                        'message'=> 'Maksimal memilih 2 univ & anda sudah memilih 2 Univ & Jurusan. Hapus pilihan anda terlebih dahulu'
                    ]
                );
            }
        }else {
            # code...
            return response()->json(
                [
                    'status'=> 400,
                    'message'=> 'Anda sudah memilih univ tersebut'
                ]
            );
        }
    }

    public function proses_rating(Request $request)
    {
        $siswa = auth()->user()->siswa;
        $univ  = Univ::find($request->univ_id);
        $rating = Rating::where('univ_id',$request->univ_id)->where('jurusan_id',$request->jurusan_id)
        ->where('siswa_id',$siswa->id)->first();

        $akreditasi = 10;
        $kkm = 10;
        $nilai;
        if ($siswa->siswa_nilai > 74 && $siswa->siswa_nilai < 81) {
            $nilai = 10;
        }elseif($siswa->siswa_nilai > 80 && $siswa->siswa_nilai < 91){
            $nilai = 15;
        }elseif($siswa->siswa_nilai > 90 && $siswa->siswa_nilai < 96){
            $nilai = 20;
        }elseif ($siswa->siswa_nilai > 95 && $siswa->siswa_nilai <= 100) {
            $nilai = 25;
        }else {
            $nilai = 0;
        }

        $ranking;
        if ($siswa->siswa_ranking == 1) {
            $ranking = 10;
        }elseif($siswa->siswa_ranking == 2){
            $ranking = 7;
        }elseif($siswa->siswa_ranking == 3){
            $ranking = 5;
        }else {
            $ranking = 0;
        }

        $sertifikat;
        if ($siswa->siswa_sertifikat > 0 && $siswa->siswa_sertifikat <= 3) {
            $sertifikat = 7;
        }elseif($siswa->siswa_sertifikat > 3 && $siswa->siswa_sertifikat <= 5){
            $sertifikat = 15;
        }elseif($siswa->siswa_sertifikat > 5){
            $sertifikat = 20;
        }else {
            $sertifikat = 0;
        }

        $domisili;
        if ($siswa->kota == $univ->kota->kota_name) {
            $domisili = 10;
        }else {
            $domisili = 5;
        }

        $linjur;
        if ($request->linjur == 'linjur') {
            $linjur = 5;
        }else {
            $linjur = 10;
        }

        $alumni;
        if ($univ->univ_alumni > 0 && $siswa->siswa_sertifikat <= 5) {
            $alumni = 5;
        }elseif($univ->univ_alumni > 5 && $siswa->siswa_sertifikat <= 10){
            $alumni = 10;
        }elseif($univ->univ_alumni > 10){
            $alumni = 15;
        }else {
            $alumni = 0;
        }

        $score = $akreditasi + $kkm + $nilai + $ranking + $sertifikat + $linjur + $domisili + $alumni;

        $data = Rating::updateOrCreate(
            [
                'univ_id'=> $request->univ_id,
                'jurusan_id'=> $request->jurusan_id,
                'siswa_id'=> $siswa->id,
            ],[
                'univ_id'=> $request->univ_id,
                'jurusan_id'=> $request->jurusan_id,
                'siswa_id'=> $siswa->id,
                'kelas'=> $siswa->nama_kelas,
                'jurusan'=> $siswa->jurusan_kelas,
                'angkatan'=> $siswa->angkatan,
                'akreditasi'=> $akreditasi,
                'kkm'=> $kkm,
                'nilai'=> $nilai,
                'ranking'=> $ranking,
                'sertifikat'=> $sertifikat,
                'linjur'=> $linjur,
                'domisili'=> $domisili,
                'alumni' => $alumni,
                'score'=> $score
            ]
        );

        return response()->json(
            [
                'status'=> 200,
                'message'=> 'Rating berhasil dijalankan'
            ]
        );
    }

    public function my_choice(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $siswa = auth()->user()->siswa;
            if ($siswa !== null) {
                # code...
                $pilih = Pilih::where('siswa_id', $siswa->id)->get();
                if ($pilih->count() > 0) {
                    # code...
                    return response()->json([
                        'status'=>200,
                        'message'=>'Kamu sudah memilih PTN. Lihat rating kemungkinan lolos PTN kamu',
                        'data'=>$pilih,
                        'total'=>$pilih->count()
                    ]);
                }else {
                    # code...
                    return response()->json([
                        'status'=>200,
                        'message'=>'Data siswa updated namun belum melakukan pemilihan PTN',
                        'total'=>$pilih->count()
                    ]);
                }
            }else {
                # code...
                return response()->json([
                    'status'=>400,
                    'message'=>'Data siswa belum dilengkapi',
                ]);
            }
        }
    }

    public function hapus_ptn_pilihan(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $pilih = Pilih::find($request->id);
            $rating = Rating::where('univ_id',$pilih->univ_id)->where('jurusan_id',$pilih->jurusan_id)
            ->where('siswa_id',$pilih->siswa_id)->first();
            if ($pilih !== null) {
                # code...
                if ($rating !== null) {
                    # code...
                    $rating->delete();
                }
                $pilih->delete();
                return response()->json([
                    'status'=>200,
                    'message'=>'Sukses menghapus PTN pilihan',
                ]);
            }else {
                # code...
                return response()->json([
                    'status'=>400,
                    'message'=>'Data PTN pilihan tidak ditemukan',
                ]);
            }

        }
    }

    public function filter_jurusan($jurusan)
    {
        $decode = base64_decode($jurusan);
        $id = explode(',',$decode);
        // $data = Jurusan::whereIn('id',$id)->get();

        $data = Univ::whereHas('jurusan',function($q) use ($id){
            $q->whereIn('jurusan_id',$id);
        })->with('jurusan',function($q) use ($id){
            $q->whereIn('jurusan_id',$id);
        })
        ->paginate(10);

        $univ = Univ::paginate(10);
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

        $filter_jurusan = Jurusan::whereIn('id',$id)->get();

        return view('fe_page.daftar_ptn_filter_jurusan',compact('filter_jurusan','univ','jurusan_','jurusan_2','kelengkapan','data'));
    }

    public function filter_ptn($ptn)
    {
        $id = base64_decode($ptn);
        $filter_ptn = Univ::find($id);
        $univ = Univ::paginate(10);
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

        return view('fe_page.daftar_ptn_filter_ptn',compact('filter_ptn','univ','jurusan_','jurusan_2','kelengkapan'));
    }

    public function search_ptn($ptn)
    {
        $name = base64_decode($ptn);
        $search_ptn = Univ::where('univ_name','LIKE','%'.$name.'%')
        ->paginate(10);
        $univ = Univ::paginate(10);
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

        return view('fe_page.daftar_ptn_search_ptn',compact('name','search_ptn','univ','jurusan_','jurusan_2','kelengkapan'));
    }

    public function daftar_siswa_ptn($ptn,$jurusan)
    {
        $id = base64_decode($ptn);
        $ptn_ini = Univ::find($id);

        $id2 = base64_decode($jurusan);
        $jurusan_ini = Jurusan::find($id2);

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

        $rating = Rating::where('univ_id', $ptn_ini->id)->where('jurusan_id',$jurusan_ini->id)
        ->where('angkatan',auth()->user()->siswa->angkatan)->orderBy('score','desc')->paginate(50);

        return view('fe_page.daftar_siswa_ptn_sama',compact('ptn_ini','jurusan_ini','univ','jurusan_','jurusan_2','rating','jurusan'));
    }

}