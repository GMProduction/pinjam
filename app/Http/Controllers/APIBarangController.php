<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class APIBarangController extends CustomController
{
    //

    /**
     * @return Barang[]|Collection|JsonResponse
     */
    public function getAllProduct(Request $request)
    {
        $name = $request->query->get('name');
        $barang =  Barang::where('nama_barang', 'like', '%'.$name.'%')->get();
//        $barang     = Barang::all();
        $dataBarang = [];
        foreach ($barang as $bar) {
            $keluar       = Peminjaman::where([['id_barang', '=', $bar->id], ['status', '=', 2]])->sum('qty');
            $stok         = (int)$bar->qty - (int)$keluar;
            $dataBarang[] = Arr::add($bar, 'stok', $stok);

        }
        $response = $barang->take(4);

        return $this->jsonResponse($dataBarang);

    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getProductById($id)
    {
        $barang = Barang::find($id);

        $keluar = Peminjaman::where([['id_barang', '=', $id], ['status', '=', 2]])->sum('qty');

        $stok = (int)$barang->qty - (int)$keluar;

        $barang = Arr::add($barang, 'stok', $stok);

        return $barang;
    }

}