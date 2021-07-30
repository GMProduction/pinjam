<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function updateProfileImage()
    {
        try {
            $image = $this->request->files->get('image');
            $data  = Guru::find(Auth::id());
            $string = null;

            if ($image || $image != '') {
                if ($data && $data->image) {
                    if (file_exists('../public'.$data->image)) {
                        unlink('../public'.$data->image);
                    }

                }
                $string = '/images/guru/'.$image;
                $this->uploadImage('image', $image, 'imagesGuru');
            }else{
                if ($data && $data->image) {
                    $string = $data->image;
                }
            }

            return $this->jsonResponse(['msg' => 'Berhasil memperbarui foto']);

        } catch (\Exception $err) {
            return $this->jsonResponse(['msg' => $err], 500);
        }
    }
}
