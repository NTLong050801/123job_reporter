<?php

namespace Workable\AuditLog\Services;

use Workable\AuditLog\Repository\Activity\ActivityRepositoryInterface;

class ActivityService
{
    protected $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }
    public function list($filter =false, $sort = false, $paginate = 20)
    {
        $item = $this->activityRepository->list($filter, $sort, $paginate);
        return $item;
    }
}
