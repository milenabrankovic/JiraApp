<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';

    public $primary_key = 'log_id';


    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'log_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
