<?php

namespace Modules\Report\Entities;

use Illuminate\Database\Eloquent\Model;
use Workable\ManagerSite\Models\Site;

class Monitor extends Model
{
    protected $fillable = [];
    protected $table='monitors';

    public function Site() {
        return $this->belongsTo(Site::class,'site_id');
    }
}
