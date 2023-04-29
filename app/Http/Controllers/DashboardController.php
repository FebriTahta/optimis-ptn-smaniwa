<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Univ;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('page.dashboard');
    }

    public function total_dashboard(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $siswa = Siswa::count();
            $univ  = Univ::count();
            $siswa_rating = Siswa::whereHas('rating')->count();
            $siswa_belum_rating = $siswa - $siswa_rating;

            return response()->json([
                'status'=>200,
                'message'=>'Menampilkan total data',
                'data'=>[
                    'siswa'=>$siswa,
                    'univ'=>$univ,
                    'siswa_rating'=>$siswa_rating,
                    'siswa_belum_rating'=>$siswa_belum_rating,
                ]
            ]);
        }
    }
}
