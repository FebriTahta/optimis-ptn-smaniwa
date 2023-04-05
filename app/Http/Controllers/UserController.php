<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pilih;
use App\Models\Rating;
use Excel;
use App\Imports\UserImport;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function daftar_user(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = User::orderBy('id','DESC')->get();
            return DataTables::of($data)
            ->addColumn('opsi', function($data) {
                $btn  = ' <button class="btn btn-sm btn-danger" data-id="'.$data->id.'"
                data-toggle="modal" data-target="#modalhapus"><i style="margin-left: 15px" class="fa fa-trash"></i></button>';
                $btn .= ' <button class="btn btn-sm btn-info" data-role="'.$data->role.'"
                 data-id="'.$data->id.'" data-name="'.$data->name.'" data-pass="'.$data->pass.'"
                 data-toggle="modal" data-target="#modaladd"><i style="margin-left: 15px" class="fa fa-edit"></i></button>';
                return $btn;
            })
            ->rawColumns(['opsi'])
            ->make(true);
        }

        return view('page.user');
    }

    public function total_user()
    {
        $total = User::count();
        return response()->json([
            'status'=>200,
            'message'=>'menampilkan total user',
            'total'=> $total
        ]);
    }

    public function add_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:20',
            'pass'    => 'required|',
            'role' => 'required|',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => $validator->messages().'',
            ]);

        }else {
            $data = User::updateOrCreate(
                [
                    'id'=> $request->id,
                ],
                [
                    'name'=> $request->name,
                    'pass'=> $request->pass,
                    'password'=> Hash::make($request->pass),
                    'role'=> $request->role
                ]
            );
            return response()->json([
                'status'=> 200,
                'message'=> 'Data user has been added'
            ]);
        }
    }

    public function hapus_user(Request $request)
    {
        if ($request->id == auth()->user()->id) {
            # code...
            return response()->json([
                'status'=>400,
                'message'=> 'Tidak bisa menghapus user sendiri' 
            ]);
        }else {
            # code...
            $user = User::find($request->id);
            $siswa= Siswa::where('user_id', $user->id)->first();
            
            if ($siswa !== null) {
                # code...
                if (count($siswa->pilih) > 0) {
                    # code...
                    Pilih::where('siswa_id',$siswa->id)->delete();
                }

                if (count($siswa->rating) > 0) {
                    # code...
                    Rating::where('siswa_id', $siswa->id)->delete();
                }

                $siswa->delete();
            }

            $user->delete();

            return response()->json([
                'status'=>200,
                'message'=> 'user has been deleted' 
            ]);
            
        }
        
    }

    public function import_user(Request $request)
    {
        Excel::import(new UserImport(), request()->file('file'));
        return redirect()->back()->with('success','data user berhasil diimport');
    }
}
