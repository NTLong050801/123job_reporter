<?php

namespace Workable\AuditLog\Repository\HistoryLogin;

use Workable\Employee\Models\Admin;
use Workable\AuditLog\Models\HistoryLogin;
use Workable\AuditLog\Models\Activity;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class HistoryLoginRepository extends BaseRepository implements HistoryLoginRepositoryInterface
{
    protected $model;

    public function __construct(HistoryLogin $model)
    {
        $this->model = $model;
    }

    public function list($filter = false, $sort = false, $paginate = 20)
    {
        $query = $this->model->with('admin:id,name');
        $query = $this->scopeFilter($query, $filter);
        $query = $this->scopeSort($query, $sort);
        $item  = $query->paginate($paginate);
        return $item;
    }
    public function getActive()
    {
        $arr   = Activity::all()->pluck('description')->toArray();
        $items = Admin::whereIn('id', $arr)->paginate(10);
        return $items;
    }
}
