<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    public $primaryKey = 'company_id';


    public function projects(){

        return $this->hasMany('\App\Models\Project', 'company_id');
    }
}
