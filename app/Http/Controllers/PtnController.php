<?php

namespace App\Http\Controllers;
use Excel;
use App\Models\Univ;
use App\Models\Jurusan;
use App\Imports\PtnImport;
use DataTables;
use Illuminate\Http\Request;

class PtnController extends Controller
{
    public function univ_page()
    {
        return view('page.univ');
    }

    public function import_univ(Request $request)
    {
        Excel::import(new PtnImport(), request()->file('file'));
        return redirect()->back()->with('success','data univ berhasil diimport');
    }

    public function data_univ(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Univ::with(['jurusan'])->withCount('jurusan')->get();
            return DataTables::of($data)
            ->addColumn('total_jurusan', function($data){
                return $data->jurusan_count.' - Jurusan';
            })
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-sm btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldel"><i style="margin-left: 15px" class="fa fa-trash"></i></button>';
                $btn .= ' <button class="btn btn-sm btn-info" data-id="'.$data->id.'" data-toggle="modal" data-target="#modaledit"><i style="margin-left: 15px" class="fa fa-edit"></i></button>';
                return $btn;
            })
            ->rawColumns(['total_jurusan','opsi'])
            ->make(true);
        }
    }

    public function total_univ(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $total = Univ::count();
            return response()->json([
                'status'=>200,
                'message'=>'display total univ',
                'data'=>$total
            ]);
        }
    }
}
