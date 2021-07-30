<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function dataBarangProses()
    {
        $proses = Peminjaman::with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])->where([['status', '!=', 5], ['status', '!=', 1],['status', '!=', 4],['status','!=',11]])->orderBy('created_at', 'desc')->limit(
            10
        )->get();

        return $proses;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function dataBarangDipinjam()
    {
        $pinjam = Peminjaman::with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])->where('status', '=', 4)->orderBy('created_at', 'desc')->limit(10)->get();

        return $pinjam;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $proses = $this->dataBarangProses();
        $pinjam = $this->dataBarangDipinjam();

        return view('admin.dashboard')->with(['pinjam' => $pinjam, 'proses' => $proses]);

    }
}
