<?php

namespace Workable\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\Admin;

class Product extends Model
{
    protected $fillable = [];

    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
