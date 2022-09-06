<?php


namespace Workable\AuditLog\Repository\Activity;

use Workable\AuditLog\Models\Activity;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface
{
    protected  $model;

    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }

    public function list($filter = false, $sort = false, $paginate = 20)
    {
        $query = $this->model->with('admin:id,name');
        $query = $this->scopeFilter($query, $filter);
        $query = $this->scopeSort($query, $sort);
        $item  = $query->paginate($paginate);
        return $item;
    }
}
