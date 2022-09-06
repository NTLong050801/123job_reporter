<?php


namespace Workable\Organization\Services;


use Illuminate\Support\Str;
use Workable\Organization\Models\CompanyStatusEnum;
use Workable\Organization\Repository\Company\CompanyRepositoryInterface;
use Workable\Support\Traits\RecursiveClassTrait;

class CompanyService
{
    use RecursiveClassTrait;
    protected $companyRepository;

    /**
     * CompanyService constructor.
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param array $filter
     * @return mixed
     */
    public function list($filter = [])
    {
        $items = $this->companyRepository->list($filter);
        return $items;
    }

    /**
     * @return array
     */
    public function listChildLevel()
    {
        $items = $this->companyRepository->getAll(false, false, false, ['id', 'name', 'parent_id']);
        $items = $this->sort($items);
        $this->sortLevel($items, 0);
        return $this->menu;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $data['updated_at'] = now();
        $data['parent_id'] = (int)$data['parent_id'];
        return $this->companyRepository->update($id, $data);
    }

    /**
     * @param $companyId
     * @return mixed
     */
    public function findOne($companyId)
    {
        return $this->companyRepository->findById($companyId);
    }

    /**
     * @param $data
     */
    public function insert($data)
    {
        $data['slug'] = Str::slug($data['name']);
        $data['parent_id'] = (int)$data['parent_id'];
        $data['created_at'] = now();
        $data['updated_at'] = now();
        $this->companyRepository->insert($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->companyRepository->update($id, [
            'status' => CompanyStatusEnum::STATUS_IN_ACTIVE
        ]);
    }
}
