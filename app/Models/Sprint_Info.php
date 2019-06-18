<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint_Info extends Model
{
    protected $table = 'sprint_info';

    public $primaryKey = 'sprint_info_id';

    
    public function sprints()
    {
        return $this->hasMany('App\Models\Sprint', 'sprint_info_id');
    }
}
