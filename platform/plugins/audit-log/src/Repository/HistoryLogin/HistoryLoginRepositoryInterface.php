<?php

namespace Workable\AuditLog\Repository\HistoryLogin;

interface HistoryLoginRepositoryInterface
{
    public function list($filter = false, $fields = false, $paginate = 20);

    public function getActive();
}
