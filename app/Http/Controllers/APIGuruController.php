<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class APIGuruController extends CustomController
{
    //
    public function index()
    {
        try {
            $user = User::with(['getGuru'])->where('roles','=','guru')->find(Auth::id());
            if ($this->request->isMethod('POST')) {
                $this->request->validate(
                    [
                        'nama'    => 'required|string',
                        'alamat'  => 'required|string',
                        'tanggal' => 'required',
                    ]
                );
                $guru = Guru::where('id_user', '=', $user->id);
                $guru->update($this->request->all());
                $user = User::with(['getSiswa'])->find($user->id);
            }

            return $this->jsonResponse($user, 200);

        } catch (\Exception $er) {
            return $this->jsonResponse('error '.$er, 500);
        }
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
                    'alamat'   => 'required',
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
            $image = $this->request->files->get('image');
            $data   = User::find(Auth::id());
            $string = null;

            if ($image || $image != '') {
                if ($data && $data->image) {
                    if (file_exists('../public'.$data->image)) {
                        unlink('../public'.$data->image);
                    }

                }
                $string = '/images/guru/'.$image;
                $this->uploadImage('image', $image, 'imagesGuru');
                $data->getGuru->update([
                    'image' => $string
                ]);
            }else{
                if ($data && $data->image) {
                    $string = $data->image;
                }
            }

            return $this->jsonResponse(['msg' => 'Berhasil memperbarui foto']);

        } catch (\Exception $err) {
            return $this->jsonResponse(['msg' => $err->getMessage()], 500);
        }
    }
}
