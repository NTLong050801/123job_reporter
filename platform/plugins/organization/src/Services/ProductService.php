<?php

namespace Workable\Organization\Services;

use Workable\Organization\Enum\ProductStatusEnum;
use Workable\Organization\Repository\Product\ProductRepositoryInterface;
use Workable\Support\Traits\RecursiveClassTrait;

class ProductService
{
    use RecursiveClassTrait;
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function list($filter)
    {
        return $this->productRepository->list($filter);
    }

    public function listByCompanyId($companyId)
    {
        $filter = [
            [
                'company_id', '=', $companyId
            ],
            [
                'status', '=', ProductStatusEnum::STATUS_ACTIVE
            ]
        ];
        $field = ['id', 'type', 'company_id', 'name', 'parent_id'];
        $items = $this->productRepository->listChildLevel($filter, $field);
        $items = $this->sort($items);
        $this->sortLevel($items, 0);
        return $this->menu;
    }

    public function countChild($productId)
    {
        $filter = [
            [
                'parent_id', '=', $productId
            ],
            [
                'status', '=', ProductStatusEnum::STATUS_ACTIVE
            ]
        ];
        $total = $this->productRepository->countBy($filter);
        return $total;
    }

    public function findById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function store($data = [])
    {
        $data['parent_id'] = (int)$data['parent_id'];
        $data['created_at'] = now();
        $data['updated_at'] = now();
        return $this->productRepository->insert($data);
    }

    public function update($id, $data = [])
    {
        $data['parent_id'] = (int)$data['parent_id'];
        $data['updated_at'] = now();

        return $this->productRepository->update($id, $data);
    }

    public function stop($id)
    {
        $data = [
            'status' => ProductStatusEnum::STATUS_INACTIVE
        ];
        return $this->productRepository->update($id, $data);
    }
}
