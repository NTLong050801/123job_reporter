<?php

namespace Workable\Candidate\Repository\CareerReport;

use App\Helpers\classes\FilterHelperCustom;
use Illuminate\Support\Facades\DB;
use Workable\Candidate\Models\CareerReport;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class CareerReportRepository extends BaseRepository implements CareerReportRepositoryInterface
{
    protected $model;
    protected $param = [];

    public function __construct(CareerReport $model)
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
            [$column, $direction] = ['id', 'desc'];
            $query = $query->orderBy($column, $direction);
        }

        return $query->paginate($paginate);
    }

    /**
     * Note:
     * @return mixed
     * Date: 10/04/2021
     */
    public function getCareerReport()
    {
        $query       = $this->model->whereRaw('1=1');
        $month_range = $this->param['month_range'];
        if ($this->param['month_range'])
        {
            $month_range = FilterHelperCustom::getStartEndMonthTimestamp($this->param['month_range']);
        }
        //        else
        //        {
        //            $month_range = FilterHelperCustom::getStartEndMonthTimestamp();
        //        }
        $result = $query
            ->when($month_range, function ($query) use ($month_range)
            {
                return $query->where('timestamp', '>=', $month_range['start'])
                    ->where('timestamp', '<=', $month_range['end']);
            })
            ->select(
                DB::raw('SUM(total) as count, month(date) as month, year(date) as year, career_id, date, career_text')
            )->groupBy('month', 'year', 'career_id')
            ->get();

        return $result;
    }

    /**
     * Note:
     * @return mixed
     * User: TranLuong
     * Date: 10/04/2021
     */
    public function getCareerReportNew()
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

        $query = $query->where('timestamp', '>=', $month_range['start'])
            ->where('timestamp', '<=', $month_range['end']);

        if ($this->param['careers_id'] && !empty($this->param['careers_id']))
        {
            $query = $query->whereIn('career_id', $this->param['careers_id']);
        }
        else
        {
            $query = $query->limit(1);
        }

        return
            $query->select(
                DB::raw('SUM(total) as count, month(date) as month, year(date) as year, career_id, date, career_text')
            )->groupBy('month', 'year', 'career_id')
                ->get();
    }

    /**
     * Note:
     * @param int $limit
     * User: TranLuong
     * Date: 13/04/2021
     */
    public function getTopCareer($limit = 1)
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

        $query = $query->where('timestamp', '>=', $month_range['start'])
            ->where('timestamp', '<=', $month_range['end']);

        return $query->select(
            DB::raw('SUM(total) as count, career_id, career_text')
        )->groupBy('career_id')
            ->orderBY('count', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getReportTable()
    {
        $month_range = request('month_range');
        if ($month_range)
        {
            $month_range = FilterHelperCustom::getStartEndMonthTimestamp($month_range);
        }
        $result = \DB::table('career_reports')
            ->select(\DB::raw("DATE_FORMAT(date, '%m/%Y') as time, career_id, career_text, SUM(total) AS total"))
            ->when($month_range, function ($query) use ($month_range)
            {
                return $query->where('timestamp', '>=', $month_range['start'])
                    ->where('timestamp', '<=', $month_range['end']);
            })
            ->groupBy('time', 'career_id', 'career_text')
            ->get();

        return $result;
    }
}
