<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends CustomController
{

    /**
     * @return Mapel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        //
        return Mapel::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
        $this->request->validate([
            'nama_mapel' => 'required|string'
        ]);

        $guru = Guru::find($this->request->get('id_guru'));
        if ( ! $guru) {
            return 'tidak ada data guru';
        }
        return Mapel::create($this->request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Mapel::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param null $id
     *
     * @return false|mixed
     */
    public function update( $id)
    {
        $mapel = Mapel::find($id);
        return $mapel->update($this->request->all());
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function destroy($id)
    {
        //
        return Mapel::destroy($id);
    }

}
