<?php

namespace Modules\Report\Repository;

use Illuminate\Support\Carbon;
use Modules\Report\Entities\Robot;

class RobotRepository
{


    protected $model;

    public function __construct(Robot $model)
    {
        $this->model = $model;
    }

    public function getList($site_id) {
        $model = $this->model;
        $query= $model->where('site_id',$site_id)
            ->where( 'time', '>', Carbon::now()->subDays(30))
            ->get();

        return $query;
    }
}
