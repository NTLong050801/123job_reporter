<?php

namespace Workable\AuditLog\Repository\Activity;

interface ActivityRepositoryInterface
{
    public function list($filter = false, $sort = false, $paginate = 20);
}
