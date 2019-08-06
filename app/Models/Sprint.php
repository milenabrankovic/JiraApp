<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $table = 'sprint';

    public $primaryKey = 'sprint_id';


    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'sprint_id');
    }

    public function sprint_info()
    {
        return $this->belongsTo('App\Models\Sprint_Info', 'sprint_info_id');
    }
}