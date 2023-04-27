<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class TokenWebController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = Auth::user()->update([
            'web_token'=>$request->token
        ]);
        return response()->json(['data'=>$data],201);
    }
}
