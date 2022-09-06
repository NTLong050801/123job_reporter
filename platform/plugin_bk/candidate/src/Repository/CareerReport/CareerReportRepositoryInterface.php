<?php

namespace Workable\Candidate\Repository\CareerReport;

interface CareerReportRepositoryInterface
{
    public function setParam($params);
    public function list($filter = [], $field = ["*"], $paginate = 20);
    public function getCareerReport();
    public function getCareerReportNew();
    public function getTopCareer($limit = 1);
    public function getReportTable();
}
