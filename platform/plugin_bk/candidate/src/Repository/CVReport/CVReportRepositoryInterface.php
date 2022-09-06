<?php

namespace Workable\Candidate\Repository\CVReport;

interface CVReportRepositoryInterface
{
    public function setParam($params);

    public function list($filter = [], $field = ["*"], $paginate = 20);

    public function statistic($filter = []);
}
