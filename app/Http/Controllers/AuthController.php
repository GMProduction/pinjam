<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function register(Request $r)
    {
        $field = $r->validate(
            [
                'name'     => 'required|string',
                'username' => 'required|string|unique:users,username',
                'password' => 'required|string|confirmed',
            ]
        );

        $user = \App\Models\User::create(
            [
                'name'     => $field['name'],
                'username' => $field['username'],
                'password' => Hash::make($field['password']),
                'roles'    => $r->get('roles') == '' ? 'siswa' : $r->get('roles'),
            ]
        );

        $response = [
            'user' => $user,
        ];

        $model    = 'Staf';

        if ( ! $r->get('roles')) {
            $model    = 'Siswa';
            $token    = $user->createToken('app')->plainTextToken;
            $response = Arr::add($response, 'token', $token);
        }elseif ($r->get('roles') === 'guru'){
            $model    = 'Guru';
        }

        $models = '\\App\\Models\\'.$model;
        $member  = $models::create(
            [
                'id_user' => $user->id,
            ]
        );
//        $response = Arr::add($response, 'user', [$model => $member]);
        return response($response, 200);

    }
}
