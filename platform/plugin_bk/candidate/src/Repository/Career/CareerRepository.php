<?php
namespace Workable\Candidate\Repository\Career;
use Workable\Support\Repositories\Eloquent\BaseRepository;
use Workable\Candidate\Models\Career;
class CareerRepository extends BaseRepository implements CareerRepositoryInterface
{
    protected $model;
    protected $param=[];

    public function __construct(Career $model)
    {
        $this->model = $model;
    }

    /**
    * Set params
    * @param array $params
    * @return void;
    */
    public function setParam($params =[])
    {
        $this->param = $params;
    }

    /**
    * Get list
    * @param array $filter
    * @param array $field
    * @param int $paginate
    * @return mixed;
    */
    public function list($filter=[], $field=["*"], $paginate=20)
    {
        $query = $this->model->whereRaw('1=1');
        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }

        $order = $this->param['order'] ?? [];
        if ($order)
        {
            $query = $this->scopeSort($query, $order);
        }
        else
        {
            list($column, $direction) = ['id', 'desc'];
            $query = $query->orderBy($column, $direction);
        }
        return $query->get();
    }
}
