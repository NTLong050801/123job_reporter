<?php


namespace Workable\Organization\Repository\Department;


interface DepartmentRepositoryInterface
{
    public function list($filter=[], $field=['*'], $paginate=20);
    public function listChildTable($filter=[], $field=['*']);
}
