<?php

namespace Workable\Candidate\Repository\CVReport;

use App\Helpers\classes\FilterHelperCustom;
use Workable\Candidate\Models\CVReport;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class CVReportRepository extends BaseRepository implements CVReportRepositoryInterface
{
    protected $model;
    protected $param = [];

    public function __construct(CVReport $model)
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
     * @return mixed
     */
    public function list($filter = [], $field = ["*"], $paginate = 20)
    {
        $query = $this->model->select($field);
        if ($this->param['month_range'])
        {
            $month_range = FilterHelperCustom::getStartEndMonthTimestamp($this->param['month_range']);
        }
        else
        {
            $month_range = FilterHelperCustom::getStartEndMonthTimestamp();
        }

        $query->where('timestamp', '>=', $month_range['start'])
            ->where('timestamp', '<=', $month_range['end']);

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

    public function statistic($filter = [])
    {
        //        return \DB::select("
        //            SELECT `timestamp`, date, SUM(total) AS total, (SELECT SUM(total) FROM cv_reports AS extra WHERE extra.`timestamp` <= main.`timestamp`) AS amount
        //            FROM cv_reports AS main
        //            GROUP BY `timestamp`, date, amount
        //            ORDER BY timestamp DESC
        //        ");
        $source = $this->param['source'] ?? null;
        $query  = \DB::table('cv_reports AS main');
        if ($source != null)
        {
            $query = $query->selectRaw("`timestamp`, date, SUM(total) AS total, (SELECT SUM(total) FROM cv_reports AS extra WHERE extra.`timestamp` <= main.`timestamp` AND source_int = " . $source . ") AS amount");
        }
        else
        {
            $query = $query->selectRaw("`timestamp`, date, SUM(total) AS total, (SELECT SUM(total) FROM cv_reports AS extra WHERE extra.`timestamp` <= main.`timestamp`) AS amount");
        }

        $month_range = $this->param['month_range'] ?? null;
        if ($month_range)
        {
            $month_range = FilterHelperCustom::getStartEndMonthTimestamp($this->param['month_range']);
        }
        //        else
        //        {
        //            $month_range = FilterHelperCustom::getStartEndMonthTimestamp();
        //        }
        $result = $query
            ->when($source !== null, function ($query) use ($source)
            {
                return $query->where('source_int', $source);
            })
            ->when($month_range, function ($query) use ($month_range)
            {
                return $query->where('timestamp', '>=', $month_range['start'])
                    ->where('timestamp', '<=', $month_range['end']);
            })
            ->groupBy('timestamp', 'date', 'amount')
            ->orderBy('timestamp', 'desc')
            ->get();

        return $result;

    }
}
