<?php


namespace Workable\Organization\Repository\Company;


interface CompanyRepositoryInterface
{
    public function list($filter=[], $field=['*'], $paginate=20);
}
