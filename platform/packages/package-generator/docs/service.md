# Tạo service
Để tạo một class `Service` thì chúng ta sử dụng như sau:

```
php artisan package-make:service DemoService --package=contact --platform=plugins
```

**Ghi chú:**
- `--package`: Chỉ ra rằng class `ContactRequest` sẽ được tạo trong package `contact`.
- `--platform`: Chỉ ra rằng sẽ được tạo trong thư mục nào. Hiện tại đang ở thư mục `platform/plugins`

**Kết quả nhận được**
```
<?php
namespace Workable\Contact\Services;
use Workable\Contact\Repository\Demo\DemoRepositoryInterface;

class DemoService
{
    protected $demoRepository;

    public function __construct(DemoRepositoryInterface $demoRepository)
    {
        $this->demoRepository = $demoRepository;
    }

    /**
     * Get list record
     */
    public function list($filter=[], $param=[])
    {
        $this->demoRepository->setParam($param);
        $items = $this->demoRepository->list($filter);
        return $items;
    }

     /**
     * Find a record by id
     * @param array $filter
     * @param array $field
     * @return mixed
     */
    public function findOneBy($filter=[], $field=['*'])
    {
        $filter = [
            'filter' => $filter,
        ];
        $item = $this->demoRepository->findBy($filter, $field);
        return $item;
    }

    /**
     * Find a record by id
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $item = $this->demoRepository->findById($id);
        return $item;
    }

    /**
     * Insert a record by array data
     * @param array $data
     * @return mixed
     */
    public function insert($data=[])
    {
        $data['created_at'] = now();
        $data['updated_at'] = now();
        $result = $this->demoRepository->insert($data);
        return $result;
    }

    /**
     * Update record bh id
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data=[])
    {
        $data['updated_at'] = now();
        $result = $this->demoRepository->update($id, $data);
        return $result;
    }

    /**
     * Delete a record by id
     * @param $id
     */
    public function delete($id)
    {
        $this->demoRepository->delete($id);
    }

    /**
     * Change status record by id
     * @param $id
     * @return mixed
     */
    public function changeStatus($id)
    {
        $data['status'] = 0;
        $data['updated_at'] = now();
        $result = $this->demoRepository->update($id, $data);
        return $result;
    }
}

```
