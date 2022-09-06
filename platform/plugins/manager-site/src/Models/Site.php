<?php

namespace Workable\ManagerSite\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\ManagerProject\Models\Project;
use Workable\SqlLogger\Models\QuerySlow;

class Site extends Model
{
    protected $table='sites';
    protected $guarded = ['id'];
    protected $fillable = [];

    public function projects(){
        return $this->hasMany(Project::class,'site_id','id');
    }



}
