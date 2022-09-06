<?php

namespace Workable\Candidate\Repository\Candidate;

use App\Helpers\classes\FilterHelperCustom;
use Workable\Candidate\Models\Candidate;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class CandidateRepository extends BaseRepository implements CandidateRepositoryInterface
{
    /**
     * @var Candidate $model
     */
    protected $model;
    protected $param = [];

    public function __construct(Candidate $model)
    {
        $this->model = $model;
    }

    /**
     * Set params
     * @param array $params
     * @return void;
     */
    public function setParam($params = [])
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
    public function  list($filter = [], $field = ["*"], $paginate = 20)
    {
        $query       = $this->model->whereRaw('1=1');
        $month_range = null;
        if ($this->param['month_range'])
        {
            $month_range = FilterHelperCustom::getStartEndMonth($this->param['month_range']);
        }
        //        else
        //        {
        //            $month_range = FilterHelperCustom::getStartEndMonth();
        //        }

        $query->when($month_range, function ($query) use ($month_range)
        {
            return $query->where('added_at', '>=', $month_range['start'])
                ->where('added_at', '<=', $month_range['end']);
        });

        if ($filter)
        {
            $query = $this->scopeFilter($query, $filter);
        }

        $order = $this->param['order'] ?? [];
        if ($order)
        {
            $query = $this->scopeSort($query, $order);
        }
        else
        {
            [$column, $direction] = ['id', 'desc'];
            $query = $query->orderBy($column, $direction);
        }

        return $query->paginate($paginate);
    }

    public function store(array $data)
    {
        $check_phone = $this->model->where('phone', $data['phone'])->first();
        $check = false;
        if (!$check_phone){
            $check = true;
        }else{
            $check_email = $this->model->where('email', $data['email'])->first();
            if (!$check_email){
                $check = true;
            }
        }
        if ($check){
            $create = $this->model->create($data);
            return $create;
        }else{
            return false;
        }


    }
}
