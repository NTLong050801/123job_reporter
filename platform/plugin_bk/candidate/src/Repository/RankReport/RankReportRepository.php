<?php

namespace Workable\Candidate\Repository\RankReport;

use App\Helpers\classes\FilterHelperCustom;
use Illuminate\Support\Facades\DB;
use Workable\Support\Repositories\Eloquent\BaseRepository;
use Workable\Candidate\Models\RankReport;

class RankReportRepository extends BaseRepository implements RankReportRepositoryInterface
{
    protected $model;
    protected $param = [];

    public function __construct(RankReport $model)
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
    public function list($filter = [], $field = ["*"], $paginate = 20)
    {
        $query = $this->model->whereRaw('1=1');
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
            list($column, $direction) = ['id', 'desc'];
            $query = $query->orderBy($column, $direction);
        }
        return $query->paginate($paginate);
    }

    /**
     * Note:
     * @return mixed
     * Date: 10/04/2021
     *
     */
    public function getListRankDistinct()
    {
        return $this->model->distinct()->get(['rank_id', 'rank_text']);
    }

    /**
     * Note:
     * @return mixed
     * Date: 10/04/2021
     */
    public function getRankReport()
    {
        $query = $this->model->whereRaw('1=1');
        if ($this->param['month_range'])
        {
            $month_range = FilterHelperCustom::getStartEndMonthTimestamp($this->param['month_range']);
        }
        else
        {
            $month_range = FilterHelperCustom::getStartEndMonthTimestamp();
        }

        return $query->where('timestamp', '>=', $month_range['start'])
            ->where('timestamp', '<=', $month_range['end'])
            ->select(
                DB::raw('SUM(total) as count, month(date) as month, year(date) as year, rank_id, date, rank_text')
            )->groupBy('month', 'year', 'rank_id')
            ->get();
    }

    public function getReportTable()
    {
        $month_range = request('month_range');
        if ($month_range)
        {
            $month_range = FilterHelperCustom::getStartEndMonthTimestamp($month_range);
        }
        $result = \DB::table('rank_reports')
            ->select(\DB::raw("DATE_FORMAT(date, '%m/%Y') as time, rank_id, rank_text, SUM(total) AS total"))
            ->when($month_range, function ($query) use ($month_range)
            {
                return $query->where('timestamp', '>=', $month_range['start'])
                    ->where('timestamp', '<=', $month_range['end']);
            })
            ->groupBy('time', 'rank_id', 'rank_text')
            ->get();

        return $result;
    }
}
