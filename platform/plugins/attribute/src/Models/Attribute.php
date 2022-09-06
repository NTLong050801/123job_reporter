<?php

namespace Workable\Attribute\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Company\Models\Admin;

class Attribute extends Model
{
    public $table = 'attributes';

    protected $fillable = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
