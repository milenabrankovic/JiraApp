<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    public $primaryKey = 'status_id';


    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'status_id');
    }

    public function logs()
    {
        return $this->hasMany('App\Models\Log', 'status_id');
    }
}
