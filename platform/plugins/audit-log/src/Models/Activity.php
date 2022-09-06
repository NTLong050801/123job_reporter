<?php

namespace Workable\AuditLog\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\Admin;

class Activity extends Model
{
    protected $fillable = [
        'description',
        'admin_id',
        'reference_id',
        'action',
        'route',
        'ip_address',
        'browser',
        'platform',
        'request',
        'created_at',
        'updated_at'
    ];
    protected $table = 'activity_log';

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
