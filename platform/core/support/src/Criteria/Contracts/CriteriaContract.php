<?php

namespace Workable\Support\Criteria\Contracts;

use Workable\Support\Repositories\Interfaces\RepositoryInterface;

interface CriteriaContract
{
    /**
     * @param \Eloquent $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository);
}
