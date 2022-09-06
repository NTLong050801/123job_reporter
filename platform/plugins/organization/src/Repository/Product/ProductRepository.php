<?php


namespace Workable\Organization\Repository\Product;


use Workable\Organization\Models\Product;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $model;
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @param array $filter
     * @param array $field
     * @param int $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function list($filter=[], $field=['*'], $paginate=20)
    {
        $query = $this->model->with('admin:id,name', 'parent:id,name', 'company:id,name');
        if ($filter)
        {
            $query = $this->scopeFilter($query, $filter);
        }

        $items = $query->orderBy('id', 'desc')
            ->paginate($paginate);

        return $items;
    }

    /**
     * @param array $filter
     * @param array $field
     * @return mixed
     */
    public function listChildLevel($filter = [], $field = ['*'])
    {
        $query = $this->model->whereRaw('1=1');
        if ($filter)
        {
            $query = $this->scopeFilter($query, $filter);
        }

        $items = $query->orderBy('id', 'desc')
            ->get($field);
        return $items;
    }
}
