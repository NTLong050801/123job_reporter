<?php
namespace Workable\Attribute\Repository;

interface AttributeRepositoryInterface
{
    public function list($filter=[], $field=['*'], $paginate=20);
}
