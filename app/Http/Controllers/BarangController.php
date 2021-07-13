<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends CustomController
{

    /**
     * @return Barang[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllProduct(){
       return Barang::all();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getProductById($id){
        return Barang::find($id);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getProductByName($name){
        return Barang::where('nama_barang','like','%'.$name.'%')->get();
    }

    /**
     * @param Request $r
     *
     * @return mixed
     */
    public function createProduct(Request $r){
        $r->validate([
            'nama_barang' => 'required|string',
            'qty' => 'required|int'
        ]);

        return Barang::create($r->all());
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function destroy($id){
        return Barang::destroy($id);
    }

}
