<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function dashboard()
    {
        return view('dashboard');
    }

    public function projects_list()
    {
        return view('projects.projects_list');
    }

    public function projects_assignment()
    {
        return view('projects.projects_assignment');
    }

    public function projects_crud()
    {
        return view('projects.projects_crud');
    }

    public function user_projects()
    {
        return view('projects.projects_by_user');
    }

    public function tasks()
    {
        return view('tasks');
    }

    public function configuration()
    {
        return view('configuration');
    }

    public function users_crud()
    {
        return view('users_crud');
    }

    public function login()
    {
        return view('login');
    }

}
