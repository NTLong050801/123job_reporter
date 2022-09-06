<?php


namespace Workable\Organization\Repository\Company;


use Workable\Organization\Models\Company;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    protected $model;

    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    public function list($filter = [], $field = ['*'], $paginate = 30)
    {
        $query = $this->model->with('companyParent:id,name', 'admin:id,name');
        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }
        $items = $query->orderBy('id', 'desc')->paginate($paginate);

        return $items;
    }
}
