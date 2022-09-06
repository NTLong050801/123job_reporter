<?php

namespace Workable\Candidate\Services;

use App\Helpers\classes\FilterHelperCustom;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Workable\Candidate\Repository\RankReport\RankReportRepositoryInterface;

class RankReportService
{
    protected $rankReportRepository;

    public function __construct(RankReportRepositoryInterface $rankReportRepository)
    {
        $this->rankReportRepository = $rankReportRepository;
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
        $this->rankReportRepository->setParam($param);

        return $this->rankReportRepository->list($filter);
    }

    /**
     * Note:
     * @return mixed
     * User: TranLuong
     * Date: 09/04/2021
     */
    public function getListRankDistinct()
    {
        return $this->rankReportRepository->getListRankDistinct();
    }

    public function getRankReportChart(Request $request): array
    {
        $month_range = $request->get('month_range');
        $param       = [
            'month_range' => $month_range,
        ];
        $this->rankReportRepository->setParam($param);
        $rank_reports = $this->rankReportRepository->getRankReport()->toArray();
        $rank_reports = $this->handleTimeMonth($rank_reports, $month_range);

        return $rank_reports;
    }

    /**
     * Note:
     * @param Request $request
     * @return array
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function getRankReport(Request $request): array
    {
        $month_range = $request->get('month_range');
        $param       = [
            'month_range' => $month_range,
        ];
        $this->rankReportRepository->setParam($param);
        $reports    = $this->rankReportRepository->getReportTable();
        $range_date = $this->getRangeDate();
        $reports    = $this->transformReport($reports);
        $result     = [
            'reports' => $reports,
            'times'   => $range_date,
        ];

        return $result;
    }


    /**
     * Note:
     * @param array $rank_reports
     * @param $month_range
     * @return array
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    private function handleTimeMonth($rank_reports = [], $month_range = ''): array
    {
        $date_filter = FilterHelperCustom::getStartEndMonthSingle($month_range);
        $begin       = new DateTime($date_filter['start']);
        $end         = new DateTime($date_filter['end']);

        $arr_rank = [];
        $arr_time = [];
        for ($i = $begin; $i <= $end; $i->modify('+1 month'))
        {
            $date_format = $i->format('m/Y');
            $arr_time[]  = $date_format;
            foreach ($rank_reports as $key => $rank)
            {
                $month   = $rank['month'];
                $year    = $rank['year'];
                $rank_id = $rank['rank_id'];
                $date    = (($month < 10) ? '0' . $month : $month) . '/' . $year;
                if ($date == $date_format)
                {
                    if (isset($arr_rank[$rank_id]['data'][$date_format]))
                    {
                        $arr_rank[$rank_id]['data'][$date_format] += $rank['count'];
                    }
                    else
                    {
                        $arr_rank[$rank_id]['detail']             = [
                            'name' => $rank['rank_text']
                        ];
                        $arr_rank[$rank_id]['data'][$date_format] = $rank['count'];
                    }
                }
                else
                {
                    if (!isset($arr_rank[$rank_id]['data'][$date_format]))
                    {
                        $arr_rank[$rank_id]['detail']             = [
                            'name' => $rank['rank_text']
                        ];
                        $arr_rank[$rank_id]['data'][$date_format] = 0;
                    }
                }
            }
        }

        return [
            'rank_reports' => $arr_rank,
            'times'        => $arr_time
        ];
    }

    private function transformReport($reports)
    {
        $data = [];
        foreach ($reports as $item)
        {
            $data[$item->rank_id]['id']                  = $item->rank_id;
            $data[$item->rank_id]['name']                = $item->rank_text;
            $data[$item->rank_id]['report'][$item->time] = $item->total;
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
        $result = \DB::table('rank_reports')
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
