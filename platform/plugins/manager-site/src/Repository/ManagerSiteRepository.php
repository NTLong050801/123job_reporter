<?php

namespace Workable\ManagerSite\Repository;

use PhpParser\Node\Stmt\If_;
use Workable\ManagerSite\Models\Site;
use Workable\Support\Repositories\Eloquent\BaseRepository;
use Workable\ManagerSite\Enum\SiteStatusEnum;

class ManagerSiteRepository extends BaseRepository
{
    protected $model;

    public function __construct(Site $site)
    {
        $this->model = $site;
    }

    public function list($filter = [], $field = ['*'], $paginate = 20)
    {
        $query = $this->model;
        //dd($query);
        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }
        $items = $query->orderBy('id', 'desc')
        ->paginate($paginate);

        return $items;

    }


    public function getSiteActive($filter,$paginate=20){
        $model = $this->model;
        if ($filter) {
            $model = $this->scopeFilter($model, $filter);
        }

        $query = $model->where('status',SiteStatusEnum::STATUS_ACTIVE)
            ->orderBy('id','DESC');

        return $paginate
            ? $query->paginate($paginate)
            : $query->ge();
    }


}
