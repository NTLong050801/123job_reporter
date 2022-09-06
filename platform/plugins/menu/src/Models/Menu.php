<?php

namespace Workable\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\Admin;

class Menu extends Model
{
    protected $table='menus';
    protected $guarded = ['id'];
    protected $fillable = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
