<?php
namespace Workable\Candidate\Repository\RankReport;

interface RankReportRepositoryInterface
{
    public function setParam($params);

    public function list($filter=[], $field=["*"], $paginate=20);
    public function getListRankDistinct();
    public function getRankReport();
    public function getReportTable();
}
