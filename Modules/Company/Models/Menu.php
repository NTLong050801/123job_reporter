<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Acl\Models\Permission;

class Menu extends Model
{
    protected $table = 'menus';
    protected $guarded = [];
    public $timestamps = true;

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'menu_id');
    }

    public function permissions_uri()
    {
        return $this->hasOne(Permission::class, 'id', 'menu_link');
    }
}
