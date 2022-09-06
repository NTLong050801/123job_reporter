<?php

namespace Workable\ApplyJob\Models;

use Illuminate\Database\Eloquent\Model;


class ApplyJob extends Model
{
    protected $table='apply_jobs';
    protected $guarded = ['id'];
    protected $fillable = [];
}
