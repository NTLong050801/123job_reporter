<?php

namespace Workable\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\Admin;
use Workable\Media\Models\Media;
use function json_decode;

class Announcement extends Model
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

    public function medias()
    {
        return Media::with('admin')->find(json_decode($this->files));
    }
}
