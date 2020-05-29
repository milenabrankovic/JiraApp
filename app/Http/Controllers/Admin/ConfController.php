<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Sprint_Info;
use App\Models\Project;
use App\Models\Sprint;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ConfController extends Controller
{
    private $data = [];

    public function activateSprint() //sprint activation
    {
            $sprint_info = Sprint_Info::where('active', 1)->first();
            $sprint_length = $sprint_info->length;
            $active_sprints = Sprint::where('active', 1)->get();
            $current_date = Carbon::now()->startOfDay();

            $projects = Project::where('start_date', $current_date)->get();
           /// dd($current_date->format('Y-m-d H:i:s'));

            foreach($projects as $project)
            {
                $check = Sprint::where('project_id', $project->project_id)->first();
                //dd($check);
                if($check == null)
                {
                    $sprint = new Sprint;
                    $sprint->start_date = $current_date->format('Y-m-d H:i:s');
                    $sprint->sprint_info_id = $sprint_info->sprint_info_id;
                    $sprint->project_id = $project->project_id;
                    $sprint->active = 1;
                    $sprint->save();
                }
               
            }

            foreach($active_sprints as $sprint){
               
                $project = Project::where('project_id', $sprint->project_id)->first();
                //dd($project);
                $sprint_date = Carbon::parse($sprint->start_date);
                $project_end_date = Carbon::parse($project->end_date);

                if(Carbon::now() >= $project_end_date)
                {   
                    Sprint::where(['project_id'=> $sprint->project_id, 'active'=> 1])->update(['active'=>0]);
                }
                else if((Carbon::now() >= $sprint_date->addDays($sprint_length)))
                {
                    Sprint::where(['project_id'=> $sprint->project_id, 'active'=> 1])->update(['active'=>0]);
                    $new_sprint = new Sprint();
                    $new_sprint->start_date = $current_date->format('Y-m-d H:i:s');
                    $new_sprint->sprint_info_id = $sprint_info->sprint_info_id;
                    $new_sprint->project_id = $sprint->project_id;
                    $new_sprint->active = 1;
                    $new_sprint->save();
                }
            }
    }


    public function company()
    {

    $company = Company::where('active', 1)->first();
    
    return $company;

    }

    public function info()
    {
        $company = Company::where('active', 1)->first();
        $sprint = Sprint_Info::where('active', 1)->first();

        $this->data['info'] = [
            'company' => $company,
            'sprint' => $sprint
        ];
        
        return $this->data;
    }

    public function save(Request $request)
    {
        Company::where('active', 1)->update(['active' => 0]);
        Sprint_Info::where('active', 1)->update(['active' => 0]);

        $company = new Company;
        $sprint_info = new Sprint_Info;

        $validator = Validator::make($request->all(), [ 
            'info.sprint_length' => 'required',
            'info.sprint_points' => 'required',
            'info.company_name' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'error',
                'msg'    => 'Invalid input'
            ], 200);
        }
        $company->name = $request->info['company_name'];
        $company->active = 1;

        $sprint_info->length = $request->info['sprint_length'];
        $sprint_info->points = $request->info['sprint_points'];
        $sprint_info->active = 1;

        if($sprint_info->save() && $company->save())
        {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Successfully updated'
            ], 200);
        }
    }
}
