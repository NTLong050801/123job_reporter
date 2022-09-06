<?php

namespace Workable\Candidate\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';
    protected $guarded = ['id'];

}
