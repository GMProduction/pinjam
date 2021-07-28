<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BarangController extends CustomController
{

    /**
     * @return Barang[]|Collection|JsonResponse
     */
    public function getAllProduct()
    {
        $uri        = $_SERVER['REQUEST_URI'];
        $barang     = Barang::all();
        $dataBarang = [];
        foreach ($barang as $bar) {
            $keluar       = Peminjaman::where([['id_barang', '=', $bar->id], ['status', '=', 2]])->sum('qty');
            $stok         = (int)$bar->qty - (int)$keluar;
            $dataBarang[] = Arr::add($bar, 'stok', $stok);

        }
        if ($uri && strpos($uri, 'api')) {
            $response = $barang->take(4);

            return $this->jsonResponse($dataBarang);
        }

        return $dataBarang;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $barang = $this->getAllProduct();

        return view('test')->with(['barang' => $barang]);
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

    public function getProductByName(Request $request)
    {
        $name = $request->query->get('name');

        return Barang::where('nama_barang', 'like', '%'.$name.'%')->get();
    }

    /**
     * @param Request $r
     *
     * @return mixed
     */
    public function createProduct()
    {
        $this->request->validate(
            [
                'nama_barang' => 'required|string',
                'qty'         => 'required|int',
            ]
        );

        return Barang::create($this->request->all());
    }

    /**
     * @return JsonResponse
     */
    public function apiCreateProduct()
    {
        try {
            $barang   = $this->createProduct();
            $code     = 200;
            $response = $barang;
        } catch (\Illuminate\Validation\ValidationException $err) {
            $code     = 500;
            $response = $err->errors() || $err->getMessage();
        }

        return $this->jsonResponse($response, $code);
    }

    /**
     * @param Request $r
     * @param $id
     *
     * @return mixed
     */
    public function updateProduct(Request $r, $id)
    {
        $barang = Barang::find($id);
        $barang->update($r->all());

        return $barang;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function destroy($id)
    {
        $del      = Barang::destroy($id);
        $response = 'Gagal hapus data';
        if ($del > 0) {
            $response = 'Berhasil hapus data';
        }

        return $response;
    }

    /**
     * @return Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function viewAllBarang()
    {
        $barang  = [
            'barang' => $this->getAllProduct()
        ];
        if ($this->request->isMethod('POST')) {
            $this->request->validate(
                [
                    'nama_barang' => 'required|string',
                    'qty'         => 'required|int',
                ]
            );
            if ($this->request->get('id')){
                $bar = Barang::find($this->request->get('id'));
                $bar->update($this->request->all());

            }else{
                Barang::create($this->request->all());
            }

            return redirect('/admin/barang');
        }

        return view('admin.barang.barang')->with($barang);
    }

}
