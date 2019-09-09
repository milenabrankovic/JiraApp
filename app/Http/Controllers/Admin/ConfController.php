<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Sprint_Info;
use Illuminate\Support\Facades\Validator;

class ConfController extends Controller
{
    private $data = [];

    public function company()
    {

    $company = Company::all()->first();
    
    return $company;

    }

    public function info()
    {
        $company = Company::all()->first();
        $sprint = Sprint_Info::all()->where('active', 1)->first();

        $this->data['info'] = [
            'company' => $company,
            'sprint' => $sprint
        ];
        
        return $this->data;
    }

    public function save(Request $request)
    {
        
        $company = Company::all()->first();

        $company->name = $request->info['company_name'];
        
        
        $sprint_info = Sprint_Info::all()->where('active', 1)->first();
        
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

        $sprint_info->length = $request->info['sprint_length'];
        $sprint_info->points = $request->info['sprint_points'];
        
        if($sprint_info->save() && $company->save())
        {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Successfully updated'
            ], 200);
        }
    }
}
