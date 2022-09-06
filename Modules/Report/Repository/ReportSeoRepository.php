<?php

namespace Modules\Report\Repository;

use Illuminate\Support\Carbon;
use Modules\Report\Entities\ReportSeo;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class ReportSeoRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = app(ReportSeo::class);
    }

    public function getList($site_id)
    {
        $model = $this->model;
        $query = $model->where('site_id', $site_id)
            ->where('time', '>', Carbon::now()->subDays(30))
            ->get();

        return $query;
    }

    public function getDate($site_id, $date)
    {

        return $this->model
            ->where('site_id', $site_id)
            ->whereDate('time', $date)
            ->first();
    }




}
