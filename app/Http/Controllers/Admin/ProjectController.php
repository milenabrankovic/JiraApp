<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Company;
use App\Http\Resources\Project as ProjectResource;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    private $project;

    public function __construct()
    {
        $company_id = Company::all()->first()->company_id;

        $this->project = new Project;
        $this->project->company_id = $company_id;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return ProjectResource::collection($projects);
    }

    public function projects_by_user(Request $request)
    {   
        $id = $request->get('id');
        $projects = User::find($id)->project;

        return $projects;
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
        
        $project = $this->project;

        $project->name = $request->project['project_name'];
        $project->description = $request->project['project_description'];
        $project->start_date = $request->project['start_date'];
        
        if($project->save())
        {
            //return new ProjectResource($project);
            
            if($request->selectedUsers != null && count($request->selectedUsers)>0) //users je name attr; provera da li je projekat dodeljen zaposlenom
            {
              // $this->assign_employee($request, $project->project_id);
                $users = $request->selectedUsers;
                $data = [];
                
                foreach($users as $user)
                { 
                    $data[] = [
                        "user_id" => $user,
                        "project_id" => $project->project_id
                    ];
                }
                
                \DB::table('project_user')->insert($data);
            }
        }
        
    }

    public function assign_employee(Request $request)
    {
        return($request);
        $users = $request->selectedUsers;

        $data = [];
        return $users;
        foreach($users as $user)
        { 
            $data = [
                "user_id" => $user,
                "project_id" => $project_id
            ];
        }

        \DB::table('project_user')->insert($data);
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
        $project = Project::findOrFail($id);

        $project->name = $request->get('project')['project_name'];
        $project->description = $request->get('project')['project_description'];
        $project->start_date = $request->get('project')['start_date'];
        
        if($project->save())
        {
            //return new ProjectResource($project);
           
            if($request->get('selectedUsers') != null) //users je name attr; provera da li je projekat dodeljen zaposlenom
            {
                $users_new = $request->get('selectedUsers');
                $users_old = \DB::table('project_user')->select('user_id')->where('project_id', $project->project_id)->get()->toArray();

                $array_new = [];
                $array_old = [];

                foreach($users_old as $old){
                    $array_old [] = $old->user_id;
                }

                // foreach($users_new as $new){
                //     $array_new [] = $new['user_id'];
                // }
                
                $result_delete = array_diff($array_old,$users_new);
                $result_add = array_diff($users_new,$array_old);

                $data_add = [];

                foreach($result_delete as $id_delete)
                {
                    \DB::table('project_user')
                    ->where([
                        ['project_id', $project->project_id],
                        ['user_id', $id_delete]
                    ])->delete();
                }
                foreach($result_add as $id_add)
                {
                    $data_add[] = [
                        'project_id' => $project->project_id,
                        'user_id' => $id_add
                    ];
                }
                
                \DB::table('project_user')->insert($data_add);
                
            }
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
        $project = Project::find($id);

        if($project->delete())
        {
            DB::table('project_user')->where('project_id', $id)->delete();
            DB::table('task')->where('project_id', $id)->delete();
            
            return new ProjectResource($project);
        }
    }

}
