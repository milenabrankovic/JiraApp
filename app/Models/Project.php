<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';

    public $primaryKey = 'project_id';

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'project_user', 'project_id', 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'project_id');
    }

    public function sprints()
    {
        return $this->hasMany('App\Models\Sprint', 'project_id');
    }
    
}
