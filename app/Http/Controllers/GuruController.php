<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    //
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $guru = User::with(['getGuru'])->where('roles','=','guru')->get();
//        return response()->json($guru);
        return view('admin.guru.guru')->with(['guru' => $guru]);
    }
}
