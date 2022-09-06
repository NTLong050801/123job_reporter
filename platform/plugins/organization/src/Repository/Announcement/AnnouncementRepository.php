<?php


namespace Workable\Organization\Repository\Announcement;


use Workable\Organization\Models\Announcement;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class AnnouncementRepository extends BaseRepository implements AnnouncementRepositoryInterface
{
    protected $model;
    public function __construct(Announcement $announcement)
    {
        $this->model = $announcement;
    }

    public function list($filter = [], $field = ['*'], $paginate = 20)
    {
        $query = $this->model->with('admin:id,name');
        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }
        $items = $query->orderBy('id', 'desc')->paginate($paginate);

        return $items;
    }

    public function find($id)
    {
        return $this->model->with('admin:id,name', 'medias')->find($id);
    }

    public function newList()
    {
        $items = $this->model->select('id', 'name')
                                ->orderBy('id', 'desc')
                                ->take(10)->get();
        return $items;
    }
}
