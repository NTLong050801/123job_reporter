<?php

namespace Workable\AuditLog\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\Admin;

class HistoryLogin extends Model
{
    protected $fillable = [];
    protected $table= 'admin_login_history';

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
