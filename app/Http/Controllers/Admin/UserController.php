<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all();
        $users = \DB::table('user')->join('role', 'role.role_id', 'user.role_id')->get();
        
        return $users;
    }

    public function roles()
    {
        $roles = Role::all();
        
        return $roles;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $user = $this->user;

        $user->first_name = $request->user['first_name'];
        $user->last_name = $request->user['last_name'];
        $user->username = $request->user['username'];
        $user->email = $request->user['email'];
        $user->password = Hash::make($request->user['password']);
        $user->role_id = $request->user['role'];
        $user->parent_id = $request->user['leader'];
        
        if($user->save()){

            return new UserResource($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->first_name = $request->user['first_name'];
        $user->last_name = $request->user['last_name'];
        $user->username = $request->user['username'];
        $user->email = $request->user['email'];
        $user->password = Hash::make($request->user['password']);
        $user->role_id = $request->user['role'];
        $user->parent_id = $request->user['leader'];
        
        if($user->save()){

            return new UserResource($user);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->delete())
        {
            return new UserResource($user);
        }
    }
}
