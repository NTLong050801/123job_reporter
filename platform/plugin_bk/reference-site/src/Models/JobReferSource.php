<?php

namespace Workable\ReferenceSite\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\Admin;

class JobReferSource extends Model
{
    protected $table='job_refer_sources';
    protected $guarded = ['id'];
    protected $fillable = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
