<?php
namespace Workable\Attribute\Services;

use Illuminate\Support\Str;
use Workable\Attribute\Enum\AttributeStatusEnum;
use Workable\Attribute\Enum\AttributeTypeEnum;
use Workable\Attribute\Repository\AttributeRepositoryInterface;

class AttributeService
{
    protected $attributeRepository;
    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @param array $filter
     * @return mixed
     */
    public function list($filter=[])
    {
        return $this->attributeRepository->list($filter);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->attributeRepository->findById($id);
    }

    public function findBy($filter=[])
    {
        return $this->attributeRepository->findBy($filter);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert($data=[])
    {
        $data['type_text'] = AttributeTypeEnum::$statusText[$data['type']]['name'];
        $data['slug'] = Str::slug($data['name']);
        $data['created_at'] = now();
        $data['updated_at'] = now();
        return $this->attributeRepository->insert($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data=[])
    {
        $data['type_text'] = AttributeTypeEnum::$statusText[$data['type']]['name'];
        $data['slug'] = Str::slug($data['name']);
        $data['updated_at'] = now();
        return $this->attributeRepository->update($id, $data);
    }


    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function status($id, $status)
    {
        $item = $this->findById($id);
        $data['status'] = $item->status == AttributeStatusEnum::STATUS_ACTIVE
                                            ? AttributeStatusEnum::STATUS_IN_ACTIVE
                                            : AttributeStatusEnum::STATUS_ACTIVE;

        $data['updated_at'] = now();
        return $this->attributeRepository->update($id, $data);
    }
}
