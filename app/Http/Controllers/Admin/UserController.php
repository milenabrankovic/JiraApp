<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Role;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $users = \DB::table('users')->join('role', 'role.role_id', 'users.role_id')->get();
        
        return $users;
    }
    public function roles()
    {
        $roles = Role::all();
        
        return $roles;
    }

    public function team(Request $request)
    {
        $user_id = $request->get('user_id');

        $team = User::select('user_id')->where('parent_id', $user_id)->get();

        return $team;
    }

    public function edit_team(Request $request, $id)
    {
        $team = $request->get('team');

        foreach($team as $t)
        {
            $user = User::find($t);
            $user->parent_id = $id;
            $user->save();
        }
        return $request->get('team');
    }

    public function users_by_project(Request $request)
    {
        $id = $request->get('project_id');
        $users = Project::find($id)->users;
        
        return $users;
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

            $validator = Validator::make($request->all(), [ 
                'user.first_name' => 'required',
                'user.last_name' => 'required',
                'user.username' => 'required',
                'user.email' => 'required',
                // 'user.password' => 'required',
                'user.role' => 'required',
            ]);

            if ($validator->fails()) {
    
                //pass validator errors as errors object for ajax response
                //return response()->json(['errors'=>$validator->errors()]);
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'Invalid input'
                ], 200);
            }

            $user->first_name = $request->user['first_name'];
            $user->last_name = $request->user['last_name'];
            $user->username = $request->user['username'];
            $user->email = $request->user['email'];
            
            if($request->user['password'] != ''){
                
                $user->password = Hash::make($request->user['password']);
            }
            $user->role_id = $request->user['role'];
            $user->parent_id = $request->user['leader'];
        
            if($user->save()){
                //return new UserResource($user);
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Successfully updated',
                    'data' => $user
                ], 200);
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