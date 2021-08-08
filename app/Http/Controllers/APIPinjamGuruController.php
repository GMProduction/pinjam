<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Guru;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

/**
 * Class APIPinjamGuruController
 * @package App\Http\Controllers
 */
class APIPinjamGuruController extends CustomController
{

    /**
     * @return Builder[]|Collection
     */
    public function index()
    {
        //
        $pinjam = Peminjaman::with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])
                            ->where('status', '=', 2)->whereHas(
                'getMapel.getGuru',
                function ($query) {
                    $query->where('id_user', '=', Auth::id());
                }
            )->get();

        return $pinjam;
    }

    public function history()
    {
        $pinjam = Peminjaman::getHistory()->with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])
                                          ->whereHas(
                'getMapel.getGuru',
                function ($query) {
                    $query->where('id_user', '=', Auth::id());
                }
            )->get();
        $dataPinjam = [];
        foreach ($pinjam as $key => $p){
            $dataPinjam[$key] = $p;
            $status = $p->status;
            $txtStatus = 'Ditolak Guru';
            if ($status == 3){
                $txtStatus = 'Menunggu Ambil';
            }elseif ($status == 4){
                $txtStatus = 'Dipinjam';
            }elseif ($status == 5){
                $txtStatus = 'Dikembalikan';
            }
            $dataPinjam[$key] = Arr::add($dataPinjam[$key],'txt_status',$txtStatus);
        }
        return $pinjam;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        $pinjam = Peminjaman::with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])
                            ->whereHas(
                                'getMapel.getGuru',
                                function ($query) {
                                    return $query->where('id_user', '=', Auth::id());
                                }
                            )->orderBy('created_at', 'desc')->find($id);

        return $this->jsonResponse($pinjam, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function update($id)
    {
        //
        $pinjam = Peminjaman::with(['getMapel.getGuru', 'getGuru'])
                            ->whereHas(
                                'getMapel.getGuru',
                                function ($query) {
                                    return $query->where('id_user', '=', Auth::id());
                                }
                            )->orderBy('created_at', 'desc')->find($id);
        $fild = $this->request->validate([
           "status" => 'required'
        ]);
        $status = $this->request->get('status');
        if ($pinjam) {
            $guru = Guru::where('id_user', '=', Auth::id())->first();
            $pinjam->update(
                [
                    'status'  => $fild['status'],
                    'id_guru' => $guru->id,
                ]
            );

            return $this->jsonResponse($pinjam);
        }

        return $this->jsonResponse('Data tidak ditemukan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Peminjaman::destroy($id);
    }
}
