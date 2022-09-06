<?php

namespace Workable\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\Admin;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [];

    public function companyParent()
    {
        return $this->belongsTo(Company::class, 'parent_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
