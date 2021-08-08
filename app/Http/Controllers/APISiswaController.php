<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile()
    {
        try {
            $username = User::where([['username', '=', $this->request->get('username')], ['id', '!=', Auth::id()]])->first();
            if ($username) {
                return response()->json(
                    [
                        "msg" => "The username has already been taken.",
                    ],
                    '201'
                );
            }
            $field = $this->request->validate(
                [
                    'nama'     => 'required|string',
                    'password' => 'required|string|confirmed',
                    'tanggal'  => 'required',
                    'kelas'    => 'required',
                    'alamat'   => 'required',
                    'no_hp'    => 'required',
                ]
            );

            $user = User::find(Auth::id());
            $user->update(
                [
                    'username' => $this->request->get('username'),
                ]
            );
            if (strpos($this->request->get('password'), '*') === false) {
                $user->update(
                    [
                        'password' => Hash::make($field['password']),
                    ]
                );
            }

            $user->getMember->update(
                [
                    'nama'    => $field['nama'],
                    'alamat'  => $field['alamat'],
                    'tanggal' => $field['tanggal'],
                    'kelas'   => $field['kelas'],
                    'no_hp'   => $field['no_hp'],
                ]
            );

            return $this->jsonResponse(['msg' => 'Berhasil'], 500);

        } catch (\Exception $err) {
            return $this->jsonResponse(['msg' => $err->getMessage()], 500);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileImage()
    {
        try {
            $image  = $this->request->files->get('image');
            $data   = User::find(Auth::id());
            $string = null;

            if ($image || $image != '') {
                if ($data && $data->getSiswa->image) {
                    if (file_exists('../public'.$data->getSiswa->image)) {
                        unlink('../public'.$data->getSiswa->image);
                    }

                }

                $textImg = $this->generateImageName('image');
                $string = '/images/siswa/'.$textImg;
                $this->uploadImage('image', $textImg, 'imagesSiswa');
                $data->getSiswa->update(
                    [
                        'image' => $string,
                    ]
                );
            } else {
                if ($data && $data->getSiswa->image) {
                    $string = $data->getSiswa->image;
                }
            }

            return $this->jsonResponse(['msg' => 'Berhasil memperbarui foto', 'data' => $string]);

        } catch (\Exception $err) {
            return $this->jsonResponse(['msg' => $err->getMessage()], 500);
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
