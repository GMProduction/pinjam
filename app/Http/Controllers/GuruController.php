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
        return view('admin.guru.guru')->with(['guru' => $guru]);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function destroy($id){
        $del      = User::destroy($id);
        $response = 'Gagal hapus data';
        if ($del > 0) {
            $response = 'Berhasil hapus data';
        }

        return $response;
    }
}
