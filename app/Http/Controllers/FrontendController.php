<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function projects()
    {
        return view('projects');
    }

    public function configuration()
    {
        return view('configuration');
    }
}
