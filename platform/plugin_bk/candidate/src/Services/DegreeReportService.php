<?php

namespace Workable\Candidate\Services;

use App\Helpers\classes\FilterHelperCustom;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Workable\Candidate\Repository\DegreeReport\DegreeReportRepositoryInterface;

class DegreeReportService
{
    protected $degreeReportRepository;

    public function __construct(DegreeReportRepositoryInterface $degreeReportRepository)
    {
        $this->degreeReportRepository = $degreeReportRepository;
    }

    /**
     * Note:
     * @param array $filter
     * @param array $param
     * @return mixed
     * User: TranLuong
     * Date: 09/04/2021
     */
    public function list($filter = [], $param = [])
    {
        $this->degreeReportRepository->setParam($param);

        return $this->degreeReportRepository->list($filter);
    }

    /**
     * Note:
     * @return mixed
     * User: TranLuong
     * Date: 09/04/2021
     */
    public function getListRankDistinct()
    {
        return $this->degreeReportRepository->getListDegreeDistinct();
    }

    public function getDegreeReportChart(Request $request): array
    {
        $month_range = $request->get('month_range');
        $param       = [
            'month_range' => $month_range,
        ];
        $this->degreeReportRepository->setParam($param);
        $degree_reports = $this->degreeReportRepository->getDegreeReport()->toArray();
        $degree_reports = $this->handleTimeMonth($degree_reports, $month_range);

        return $degree_reports;
    }

    /**
     * Note:
     * @param Request $request
     * @return array
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function getDegreeReport(Request $request): array
    {
        $month_range = $request->get('month_range');
        $param       = [
            'month_range' => $month_range,
        ];
        $this->degreeReportRepository->setParam($param);
        $reports    = $this->degreeReportRepository->getReportTable();
        $range_date = $this->getRangeDate();
        $reports    = $this->transformReport($reports);

        return [
            'reports' => $reports,
            'times'   => $range_date,
        ];
    }

    /**
     * Note:
     * @param array $degree_reports
     * @param string $month_range
     * @return array
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    private function handleTimeMonth($degree_reports = [], $month_range = ''): array
    {
        $date_filter = FilterHelperCustom::getStartEndMonthSingle($month_range);
        $begin       = new DateTime($date_filter['start']);
        $end         = new DateTime($date_filter['end']);

        $arr_degree = [];
        $arr_time   = [];
        for ($i = $begin; $i <= $end; $i->modify('+1 month'))
        {
            $date_format = $i->format('m/Y');
            $arr_time[]  = $date_format;
            foreach ($degree_reports as $key => $degree)
            {
                $month     = $degree['month'];
                $year      = $degree['year'];
                $degree_id = $degree['degree_id'];
                $date      = (($month < 10) ? '0' . $month : $month) . '/' . $year;
                if ($date == $date_format)
                {
                    if (isset($arr_degree[$degree_id]['data'][$date_format]))
                    {
                        $arr_degree[$degree_id]['data'][$date_format] += $degree['count'];
                    }
                    else
                    {
                        $arr_degree[$degree_id]['detail']             = [
                            'name' => $degree['degree_text']
                        ];
                        $arr_degree[$degree_id]['data'][$date_format] = $degree['count'];
                    }
                }
                else
                {
                    if (!isset($arr_degree[$degree_id]['data'][$date_format]))
                    {
                        $arr_degree[$degree_id]['detail']             = [
                            'name' => $degree['degree_text']
                        ];
                        $arr_degree[$degree_id]['data'][$date_format] = 0;
                    }
                }
            }
        }

        return [
            'degree_reports' => $arr_degree,
            'times'          => $arr_time
        ];
    }


    private function transformReport($reports)
    {
        $data = [];
        foreach ($reports as $item)
        {
            $data[$item->degree_id]['id']                  = $item->degree_id;
            $data[$item->degree_id]['name']                = $item->degree_text;
            $data[$item->degree_id]['report'][$item->time] = $item->total;
        }

        return $data;
    }

    private function getRangeDate()
    {
        $month_range = request('month_range');
        if ($month_range)
        {
            $month_range = FilterHelperCustom::getStartEndMonthTimestamp($month_range);
        }
        $result = \DB::table('degree_reports')
            ->select(\DB::raw("min(date) as `start`, max(date) as `end`"))
            ->when($month_range, function ($query) use ($month_range)
            {
                return $query->where('timestamp', '>=', $month_range['start'])
                    ->where('timestamp', '<=', $month_range['end']);
            })
            ->first();
        $start  = strtotime(Carbon::parse($result->start)->startOfMonth());
        $end    = strtotime(Carbon::parse($result->end)->endOfMonth());
        $range  = [];
        do
        {
            $end   = strtotime("-1 month", $end);
            $range[] = date('m/Y', $end);
        } while ($end >= $start);

        return $range;
    }
}
