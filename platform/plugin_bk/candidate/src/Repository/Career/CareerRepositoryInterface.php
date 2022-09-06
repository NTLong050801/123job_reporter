<?php
namespace Workable\Candidate\Repository\Career;

interface CareerRepositoryInterface
{
    public function setParam($params);

    public function list($filter=[], $field=["*"], $paginate=20);
}
