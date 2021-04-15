<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\Status;
use App\Models\Sprint;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    private $task;

    public function __construct()
    {
        $this->task = new Task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //list of tasks by project
    public function tasks_by_project(Request $request)
    {
        $project_id = $request->get('project_id');
        $user_id = $request->get('user_id');

        if($project_id == 0)
        {
            $tasks = DB::table('task')
                    ->join('users', 'task.parent_id', 'users.user_id')
                    ->join('status', 'task.status_id', 'status.status_id')
                    ->where('task.user_id', $user_id)
                    //->limit(10)
                    ->get();
        }
        else
        {
            $tasks = DB::table('task')
                    ->join('users', 'task.parent_id', 'users.user_id')
                    ->join('status', 'task.status_id', 'status.status_id')
                    ->where(['project_id' => $project_id, 'task.user_id' => $user_id])
                    //->limit(10)
                    ->get();
        }

        return $tasks;
    }

    public function tasks_by_parent(Request $request)
    {
        $user_id = $request->get('user_id');
        $project_id = $request->get('project_id');

        if($request->get('project_id') == 0)
        {
            $tasks = DB::table('task')
                    ->join('users', 'task.user_id', 'users.user_id')
                    ->join('status', 'task.status_id', 'status.status_id')
                    ->where('task.parent_id', $user_id)
                    //->limit(10)
                    ->get();
        }
        else
        {
            $tasks = DB::table('task')
                    ->join('users', 'task.user_id', 'users.user_id')
                    ->join('status', 'task.status_id', 'status.status_id')
                    ->where(['task.parent_id' => $user_id, 'task.project_id' => $project_id])
                    //->limit(10)
                    ->get();
        }

        return $tasks;
    }

    public function team_users(Request $request)
    {
        $user_id = $request->get('user_id');

        $team_users = DB::select( DB::raw("SELECT * 
                                           FROM (SELECT * FROM users
                                                 ORDER BY parent_id, user_id) user_sorted,
                                                (SELECT @pv := :user_id) initialisation
                                           WHERE find_in_set (parent_id, @pv) 
                                           AND LENGTH(@pv := concat (@pv, ',', user_id))"), array('user_id' => $user_id));

        return $team_users;

    }

    public function statuses()
    {
        $statuses = Status::all();

        return $statuses;
    }

    public function edit_status(Request $request)
    {
       // return $request->get('params')['status_id'];

        $task_id = $request->get('params')['task_id'];
        $status_id = $request->get('params')['status_id'];

        $task = Task::find($task_id);
        $task->status_id = $status_id;
        
        if($task->save())
        {
            return $task;    
        }
    }

    public function edit_task(Request $request)
    {
        $task_new = $request->get('params')['task'];
        
        $task_old = Task::find($task_new['id']);

        $task_old->title = $task_new['title'];
        $task_old->description = $task_new['description'];
        $task_old->parent_id = $task_new['parent_id'];
        $task_old->project_id = $task_new['project_id'];
        $task_old->sprint_id = $task_new['sprint_id'];
        $task_old->status_id = $task_new['status_id'];
        $task_old->user_id = $task_new['user_id'];
        $task_old->points = $task_new['points'];
        $task_old->save();

        return $task_old;
    }
     
    public function create_task(Request $request)
    {
        $task = new Task;
        $task_new = $request->get('params')['task'];

        $task->title = $task_new['title'];
        $task->description = $task_new['description'];
        $task->parent_id = $task_new['parent_id'];
        $task->project_id = $task_new['project_id'];
        $task->sprint_id = $task_new['sprint_id'];
        $task->status_id = $task_new['status_id'];
        $task->user_id = $task_new['user_id'];
        $task->points = $task_new['points'];
        $task->save();

        return $task;
    }

    public function active_sprint()
    {
        $sprint_id = Sprint::where('active', 1)->first();

        return $sprint_id;
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
        //
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
        //
    }
}
