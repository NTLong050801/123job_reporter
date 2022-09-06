<?php

namespace Workable\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\Admin;

class Department extends Model
{
    protected $fillable = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
