<?php
namespace Workable\Attribute\Repository;

use Workable\Attribute\Models\Attribute;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    protected $model;
    public function __construct(Attribute $attribute)
    {
        $this->model = $attribute;
    }

    /**
     * @param array $filter
     * @param array $field
     * @param int $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function list($filter = [], $field = ['*'], $paginate = 20)
    {
        $query = $this->model->with('admin:id,name');
        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }
        $items = $query->orderBy('id', 'desc')
            ->paginate($paginate);

        return $items;
    }
}
