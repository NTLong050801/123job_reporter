<?php
namespace Workable\Candidate\Repository\Candidate;

interface CandidateRepositoryInterface
{
    public function setParam($params);

    public function list($filter=[], $field=["*"], $paginate=20);

    public function store(array $data);
}
