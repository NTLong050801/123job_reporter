<?php


namespace Modules\Company\Repository\Profile;

use Workable\Employee\Models\Admin;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface
{
    protected $model;

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }
}
