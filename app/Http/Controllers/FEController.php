<?php

namespace App\Http\Controllers;
use App\Models\Univ;
use App\Models\Jurusan;
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
        return view('fe_page.daftar_ptn',compact('univ','jurusan','jurusan_','jurusan_2'));
    }

    public function my_info(Request $request)
    {
        $siswa = auth()->user()->siswa;
        return view('fe_page.my_info',compact('siswa'));
    }

}
