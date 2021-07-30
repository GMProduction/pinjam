<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class APISiswaController
 * @package App\Http\Controllers
 */
class APISiswaController extends CustomController
{
    //

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        try {
            $user = User::with(['getSiswa'])->where('roles', '=', 'siswa')->find(Auth::id());
            if ($this->request->isMethod('POST')) {
                $this->request->validate(
                    [
                        'nama'    => 'required|string',
                        'alamat'  => 'required|string',
                        'tanggal' => 'required',
                        'kelas'   => 'required',
                        'no_hp'   => 'required',
                    ]
                );
                $siswa = Siswa::where('id_user', '=', $user->id);
                $siswa->update($this->request->all());
                $user = User::with(['getSiswa'])->find($user->id);
            }

            return $this->jsonResponse($user, 200);
        } catch (\Exception $er) {
            return $this->jsonResponse('error '.$er, 500);
        }
    }

    public function updateImage()
    {
        try {
            $image = $this->request->files->get('image');
            $data  = Siswa::find(Auth::id());
            if ($image) {
                if ($data) {
                    if (file_exists('../public'.$data->image)) {
                        unlink('../public'.$data->image);
                    }
                } else {

                }
            }

        } catch (\Exception $err) {
            return $this->jsonResponse(['msg' => $err], 500);
        }
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
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
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
