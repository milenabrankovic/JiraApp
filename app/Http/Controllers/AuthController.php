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
                ], 400);
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

    public function test(){
        
        // $sprint_info = Sprint_Info::where('active', 1)->first();
        //     $sprint_length = $sprint_info->length;
        //     $active_sprints = Sprint::where('active', 1)->get();
        //     $current_date = Carbon::now()->startOfDay();

        //     foreach($active_sprints as $sprint){

        //         $sprint_date = Carbon::parse($sprint->start_date);

        //         if(Carbon::now() >= $sprint_date->addDays($sprint_length)){

        //             Sprint::where(['project_id'=> $sprint->project_id, 'active'=> 1])->update(['active'=>0]);
        //             $new_sprint = new Sprint;
        //             $new_sprint->start_date = $current_date->format('Y-m-d H:i:s');
        //             $new_sprint->sprint_info_id = $sprint_info->sprint_info_id;
        //             $new_sprint->project_id = $sprint->project_id;
        //             $new_sprint->active = 1;
        //             $new_sprint->save();
        //         }
        //     }
    }
}
