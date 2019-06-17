<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';

    public $primaryKey = 'task_id';

    
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function sprint()
    {
        return $this->belongsTo('App\Models\Sprint', 'sprint_id');
    }

    public function log()
    {
        return $this->belongsTo('App\Models\Log', 'log_id');
    }
}
