<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends CustomController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $siswa = User::with(['getSiswa'])->where('roles','=','siswa')->get();
        return view('admin.siswa.siswa')->with(['siswa' => $siswa]);
    }

}
