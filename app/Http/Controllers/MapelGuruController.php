<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Guru;
use App\Models\GuruMapel;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelGuruController extends CustomController
{

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        //
        return GuruMapel::with(['getMapel', 'getGuru'])->get();

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
    public function store()
    {
        //
        $guru = Guru::find($this->request->get('id_guru'));
        if ( ! $guru) {
            return 'tidak ada data guru';
        }

        $mapel = Mapel::find($this->request->get('id_mapel'));
        if ( ! $mapel) {
            return 'tidak ada data mapel';
        }

        return GuruMapel::create($this->request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return GuruMapel::find($id);
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
        $guru = Guru::find($this->request->get('id_guru'));
        if ( ! $guru) {
            return 'tidak ada data guru';
        }

        $mapel = Mapel::find($this->request->get('id_mapel'));
        if ( ! $mapel) {
            return 'tidak ada data mapel';
        }

        $guruMapel = GuruMapel::find($id);
        if ( ! $guruMapel) {
            return 'tidak ada data guru mapel';
        }

        $guruMapel->update($this->request->all());

        return $guruMapel;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function destroy($id)
    {
        //
        $del = GuruMapel::destroy($id);
        return $del;
    }
}
