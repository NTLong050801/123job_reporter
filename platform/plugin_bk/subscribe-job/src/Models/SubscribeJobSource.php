<?php

namespace Workable\SubscribeJob\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Modules\Company\Models\Admin;

class SubscribeJobSource extends Model
{
    protected $table='subscribe_job_sources';
    protected $guarded = ['id'];
    protected $fillable = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
