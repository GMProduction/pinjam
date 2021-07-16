<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
            $token    = $user->createToken('appsiswa')->plainTextToken;
            $response = Arr::add($response, 'token', $token);
            $us = \App\Models\User::find($user->id);
            $us->update([
                'token' => $token
            ]);
        }elseif ($r->get('roles') === 'guru'){
            $model    = 'Guru';
            $token    = $user->createToken('appguru')->plainTextToken;
            $response = Arr::add($response, 'token', $token);
            $us = \App\Models\User::find($user->id);
            $us->update([
                'token' => $token
            ]);
        }

        $models = '\\App\\Models\\'.$model;
        $member  = $models::create(
            [
                'id_user' => $user->id,
                'nama'     => $r->get('name')
            ]
        );

        $response = Arr::add($response, 'member', $member);
//        array_push($response,$model);
        return $response;

    }


    public function login(Request $r){


        $field = $r->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = \App\Models\User::where('username', $field['username'])->first();

        if (! $user || ! Hash::check($field['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $uri = $_SERVER['REQUEST_URI'];
        if(strpos($uri, 'api')){

            $user->tokens()->delete();
            $token = $user->createToken('app'.$user->roles)->plainTextToken;
            $user->update([
                'token' => $token
            ]);
            return $token;

        }else{
            return '';
        }
    }

    /**
     * @param Request $r
     *
     * @return string[]
     */
    public function logout(Request $r)
    {
        $us = \App\Models\User::find(Auth::user()->id);
        $us->update([
            'token' => null
        ]);
        Auth::user()->tokens()->delete();
        return [
            'message' => 'loged out'
        ];
    }
}
