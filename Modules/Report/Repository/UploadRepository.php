<?php

namespace Modules\Report\Repository;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Report\Entities\PublicUpload;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class UploadRepository extends BaseRepository
{
    public function __construct(PublicUpload $publicUpload)
    {
        $this->model = $publicUpload;
    }

    public function getList($site_id)
    {
        $query = $this->model->where('site_id', $site_id)
            ->whereDate('time', '>=', Carbon::now()->subDays(30))
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
