<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use JWTAuth;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Sprint_Info;
use App\Models\Sprint;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function login(Request $request)
    {
         $credentials = $request->only('username', 'password');
         
        if ( ! $token = JWTAuth::attempt($credentials)) {

                return response([
                    'status' => 'error',
                    'error' => 'invalid.credentials',
                    'msg' => 'Invalid Credentials.'
                ], 401);
        }
        return response([
                'status' => 'success',
                'data' => User::find(Auth::user()->user_id)
            ])
            ->header('Authorization', $token);
        
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->user_id);
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

    public function logout()
    {
        JWTAuth::invalidate();
        return response([
                'status' => 'success',
                'msg' => 'Logged out Successfully.'
            ], 200);
    }
}
