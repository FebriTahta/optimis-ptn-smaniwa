<?php

namespace App\Http\Controllers;
use Excel;
use App\Models\Univ;
use App\Models\Jurusan;
use App\Imports\PtnImport;
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
}
