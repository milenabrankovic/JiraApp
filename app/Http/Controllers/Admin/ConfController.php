<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

class ConfController extends Controller
{
    public function company(){

    $company = Company::all()->first();
    
    return $company;

    }
}
