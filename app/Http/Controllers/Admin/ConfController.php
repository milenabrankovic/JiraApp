<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Sprint_Info;

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

        $company->name = $request->input('company_name');
        

        $sprint_info = Sprint_Info::all()->where('active', 1)->first();
        $sprint_info->length = $request->input('sprint_length');
        $sprint_info->points = $request->input('sprint_points');
    }
}
