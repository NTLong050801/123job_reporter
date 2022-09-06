<?php


namespace Workable\Organization\Services;


use Illuminate\Support\Str;
use Workable\Organization\Enum\DepartmentStatusEnum;
use Workable\Organization\Repository\Department\DepartmentRepositoryInterface;
use Workable\Support\Traits\RecursiveClassTrait;

class DepartmentService
{
    use RecursiveClassTrait;

    protected $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @param $list
     * @return array
     */
    public function listChildTable($list, $start = 0)
    {
        $items = $this->departmentRepository->listChildTable($list);
        $items = $this->sort($items);
        $this->sortLevel($items, $start);
        return $this->menu;
    }

    /**
     * @param $filter
     * @return array
     */
    public function listChildLevel($filter)
    {
        $items = $this->departmentRepository->getAll($filter, false, false, ['id', 'name', 'parent_id']);
        $items = $this->sort($items);
        $this->sortLevel($items, 0);
        return $this->menu;
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data = [])
    {
        $data['parent_id'] = (int)$data['parent_id'];
        $data['updated_at'] = now();
        return $this->departmentRepository->update($id, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->departmentRepository->findById($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store($data = [])
    {
        $data['slug'] = Str::slug($data['name']);
        $data['parent_id'] = (int)$data['parent_id'];
        $data['created_at'] = now();
        $data['updated_at'] = now();
        return $this->departmentRepository->insert($data);
    }

    public function stop($id)
    {
        $data = [
            'status' => DepartmentStatusEnum::STATUS_IN_ACTIVE,
            'updated_at' => now()
        ];
        $this->departmentRepository->update($id, $data);
    }
}
