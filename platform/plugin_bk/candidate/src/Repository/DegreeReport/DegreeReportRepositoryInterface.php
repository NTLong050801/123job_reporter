<?php
namespace Workable\Candidate\Repository\DegreeReport;

interface DegreeReportRepositoryInterface
{
    public function setParam($params);

    public function list($filter=[], $field=["*"], $paginate=20);
    public function getListDegreeDistinct();
    public function getDegreeReport();
    public function getReportTable();
}
