<?php

namespace App\Http\Controllers;
use App\Models\Univ;
use App\Models\Jurusan;
use App\Imports\PtnImport;
use DataTables;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function jurusan_page()
    {
        return view('page.jurusan');
    }

    public function data_jurusan(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Jurusan::with(['univ'])->withCount('univ')->get();
            return DataTables::of($data)
            ->addColumn('total_univ', function($data){
                return $data->univ_count.' - Universitas';
            })
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-sm btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modaldel"><i style="margin-left: 15px" class="fa fa-trash"></i></button>';
                $btn .= ' <button class="btn btn-sm btn-info" data-id="'.$data->id.'" data-toggle="modal" data-target="#modaledit"><i style="margin-left: 15px" class="fa fa-edit"></i></button>';
                return $btn;
            })
            ->rawColumns(['total_univ','opsi'])
            ->make(true);
        }
    }

    public function total_jurusan(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $total = Jurusan::count();
            return response()->json([
                'status'=>200,
                'message'=>'display total univ',
                'data'=>$total
            ]);
        }
    }
}
