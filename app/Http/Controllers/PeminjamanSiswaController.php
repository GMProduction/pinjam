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

    public function dataBarangProses()
    {
        $pinjam     = Peminjaman::with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])->where([['status', '!=', 5]])->orderBy('created_at', 'desc');
        $status     = $this->request->get('status');
        $codeStatus = null;

        if ($status) {
            if ($status == 'Menunggu Staff') {
                $codeStatus = 0;
            } elseif ($status == 'Menunggu Guru') {
                $codeStatus = 2;
            } elseif ($status == 'Menunggu Siswa Ambil') {
                $codeStatus = 3;
            } elseif ($status == 'Di pinjam') {
                $codeStatus = 4;
            } elseif ($status == 'Di kembalikan') {
                $codeStatus = 5;
            }
            $pinjam->where('status','=',$codeStatus);

        }

        $pinjam = $pinjam->paginate(10)->withQueryString();

//        $pinjam = Peminjaman::with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])->where([['status','!=',5],['status','!=',1], ['status','!=',11]])->orderBy('created_at','desc')->get();
        return $pinjam;
    }

    public function dataBarangDikembalikan()
    {
        $pinjam = Peminjaman::with(['getSiswa', 'getBarang', 'getMapel.getGuru', 'getGuru', 'getStaf'])->where('status', '=', 5)->orderBy('created_at', 'desc')->paginate(10);

        return $pinjam;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $pinjam = $this->dataBarangProses();

        return view('admin.laporan.pinjamalat')->with(['pinjam' => $pinjam]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function history()
    {
        $kembali = $this->dataBarangDikembalikan();

        return view('admin.laporan.historyPinjamalat')->with(['kembali' => $kembali]);

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function konfirmasi()
    {

        try {
            $pinjam = Peminjaman::find($this->request->get('id'));
            $staf   = Staf::where('id_user', '=', Auth::id())->first();
            $status = $this->request->get('status');
            $pinjam->update(
                [
                    'status'  => $status,
                    'id_staf' => $staf->id,

                ]
            );
//            if ($this->request->get('status')){
//                $pinjam->update([
//                    'id_staf' =>$staf->id
//                ]);
//            }
            if ($status == 5) {
                $pinjam->update(
                    [
                        'tanggal_kembali' => $this->now,
                        'kondisi_barang' => $this->request->get('kondisi_barang')
                    ]
                );
            }

            return $this->jsonResponse(["msg" => 'Berhasil'], 200);

        } catch (\Exception $er) {
            return $this->jsonResponse(["msg" => $er->getMessage()], 500);
        }
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
