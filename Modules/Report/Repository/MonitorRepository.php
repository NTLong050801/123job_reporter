<?php

namespace Modules\Report\Repository;

use Modules\Report\Entities\Monitor;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class MonitorRepository extends BaseRepository
{

    protected $model;
    public function __construct()
    {
        $this->model = app(Monitor::class);
    }

    public function getList($filter,$paginate) {
        $query = $this->model->with('Site');
        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }
        return $paginate
            ? $query->paginate($paginate)
            : $query->get();
    }

    public function insertData($data) {

    return $this->insert($data);
    }

    public function getMonitorBySite($site_id) {
        $model = $this->model;

        return $model->where('site_id',$site_id)->get();
    }

}
