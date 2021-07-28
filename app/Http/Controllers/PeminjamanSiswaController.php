<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Mapel;
use App\Models\Peminjaman;
use App\Models\Siswa;
use App\Models\Staf;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class PeminjamanSiswaController
 * @package App\Http\Controllers
 */
class PeminjamanSiswaController extends CustomController
{

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        //
        $pinjam = Peminjaman::with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])
                            ->whereHas('getSiswa', function ($query){
                                return $query->where('id_user','=',Auth::id());
                            })
                            ->orderBy('created_at','desc')->get();
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

    public function store()
    {
//        return response()->json(
//            [
//                "id" => $this->request->get('id_barang'),
//                "id_mapel" => $this->request->get('id_mapel'),
//                "qty" => $this->request->get('qty'),
//                "tanggal_pinjam" => $this->request->get('tanggal_pinjam'),
//            ]
//        );
        $barang = Barang::find($this->request->get('id_barang'));
        if ( ! $barang) {
            return response()->json(
                [
                    'status' => 204,
                    'msg'    => 'Tidak ada barang',
                ]
            );
        }

        $mapel = Mapel::find($this->request->get('id_mapel'));
        if ( ! $mapel) {
            return response()->json(
                [
                    'status' => 204,
                    'msg'    => 'Tidak ada Mapel',
                ]
            );
        }

        $this->request->validate(
            [
                'qty'            => 'required|int',
                'tanggal_pinjam' => 'required',
            ]
        );

        return Peminjaman::create(
            [
                'id_siswa'       => Auth::id(),
                'qty'            => $this->request->get('qty'),
                'id_barang'      => $barang->id,
                'tanggal_pinjam' => $this->request->get('tanggal_pinjam'),
                'id_mapel'       => $mapel->id,
            ]
        );

    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function show($id)
    {
        //
        return Peminjaman::with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])->find($id);

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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPinjamGuru()
    {
//        dd('asd');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
