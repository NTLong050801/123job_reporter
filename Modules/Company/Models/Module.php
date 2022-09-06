<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\Admin;

class Module extends Model
{
    protected $fillable = [];
    protected $table = 'admin_permissions';

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
