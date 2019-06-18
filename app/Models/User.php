<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    public $primaryKey = 'user_id';

    public function project()
    {
        return $this->belongsToMany('App\Models\Project', 'project_user', 'user_id', 'project_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public function logs()
    {
        return $this->hasMany('App\Models\Log', 'user_id');
    }
    
}
