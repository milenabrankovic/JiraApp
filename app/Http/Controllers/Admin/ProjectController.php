<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Company;
use App\Http\Resources\Project as ProjectResource;

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

        $project = $request->isMethod('put')? Project::findOrFail($request->project_id) : $this->project;

        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->start_date = $request->input('start_date');
        
        if($project->save())
        {
            //return new ProjectResource($project);
            
            if($request->input('users') != null) //users je name attr; provera da li je projekat dodeljen zaposlenom
            {
                $users = $request->input('users');
                $data = [];
               
                foreach($users as $user)
                { 
                    $data = [
                        "user_id" => $user['user_id'],
                        "project_id" => $project->project_id
                    ];
                }

                \DB::table('project_user')->insert($data);
            }
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
            return new ProjectResource($project);
        }
    }

}
