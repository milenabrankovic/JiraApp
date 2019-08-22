<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
class AuthController extends Controller
{
    public function login(Request $request)
    {

        
         $credentials = $request->only('username', 'password');
         return response(JWTAuth::attempt($credentials));
        // if ( ! $token = JWTAuth::attempt($credentials)) {
        //         return response([
        //             'status' => 'error',
        //             'error' => 'invalid.credentials',
        //             'msg' => 'Invalid Credentials.'
        //         ], 400);
        // }
        // return response([
        //         'status' => 'success'
        //     ])
        //     ->header('Authorization', $token);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
                'status' => 'success',
                'data' => $user
            ]);
    }

    public function refresh()
    {
        return response([
                'status' => 'success'
            ]);
    }
}
