<?php

namespace Workable\Organization\Repository\Department;

use Workable\Organization\Models\Department;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    protected $model;

    public function __construct(Department $department)
    {
        $this->model = $department;
    }

    public function list($filter = [], $field = ['*'], $paginate = 20)
    {
        $query = $this->model->with('company:id,name', 'admin:id,name');
        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }
        $items = $query->orderBy('id', 'desc')
            ->paginate($paginate);

        return $items;
    }

    /**
     * @param array $filter
     * @param array $field
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Department[]
     */
    public function listChildTable($filter = [], $field = ['*'])
    {
        $query = $this->model->with('company:id,name', 'admin:id,name');
        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }

        $items = $query->orderBy('id', 'desc')
            ->get($field);

        return $items;
    }
}
