<?php

namespace Workable\Candidate\Services;

use App\Helpers\classes\FilterHelperCustom;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Workable\Candidate\Repository\CareerReport\CareerReportRepositoryInterface;

class CareerReportService
{
    protected $careerReportRepository;

    public function __construct(CareerReportRepositoryInterface $careerReportRepository)
    {
        $this->careerReportRepository = $careerReportRepository;
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
        $this->careerReportRepository->setParam($param);

        return $this->careerReportRepository->list($filter);
    }

    /**
     * Note:
     * @param Request $request
     * @return array
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function getCareerReport(Request $request): array
    {
        $month_range = $request->get('month_range');
        $param       = [
            'month_range' => $month_range,
        ];
        $this->careerReportRepository->setParam($param);
        //$career_reports = $this->careerReportRepository->getCareerReport()->toArray();
        $reports    = $this->careerReportRepository->getReportTable();
        $range_date = $this->getRangeDate();
        $reports    = $this->transformReport($reports);

        return [
            'reports' => $reports,
            'times'   => $range_date,
        ];

        //$career_reports = $this->handleTimeMonth($career_reports, $month_range);
        //return $career_reports;
    }

    /**
     * Note:
     * @param Request $request
     * @return array
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function getCareerReportNew(Request $request): array
    {
        $month_range = $request->get('month_range');
        $param       = [
            'month_range' => $month_range,
            'careers_id'  => $request->get('careers_id', [])
        ];
        $this->careerReportRepository->setParam($param);
        $career_reports = $this->careerReportRepository->getCareerReportNew()->toArray();
        $career_reports = $this->handleTimeMonth($career_reports, $month_range);

        return $career_reports;
    }

    /**
     * Note:
     * @param Request $request
     * @return mixed
     * User: TranLuong
     * Date: 13/04/2021
     */
    public function getTopCareer(Request $request): array
    {
        $month_range = $request->get('month_range');
        $param       = [
            'month_range' => $month_range,
        ];
        $this->careerReportRepository->setParam($param);
        $limit       = $request->get('limit', 5);
        $top_careers = $this->careerReportRepository->getTopCareer($limit);

        return $this->handleTopCareer($top_careers->toArray());
    }

    /**
     * Note:
     * User: TranLuong
     * Date: 13/04/2021
     * @param $top_careers
     * @return array
     */
    private function handleTopCareer($top_careers = []): array
    {
        $array_id_career = [];
        foreach ($top_careers as $career)
        {
            $array_id_career[] = $career['career_id'];
        }

        return $array_id_career;
    }

    /**
     * Note:
     * @param array $career_reports
     * @param string $month_range
     * @return array
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    private function handleTimeMonth($career_reports = [], $month_range = ''): array
    {
        $date_filter = FilterHelperCustom::getStartEndMonthSingle($month_range);
        $begin       = new DateTime($date_filter['start']);
        $end         = new DateTime($date_filter['end']);

        $arr_career = [];
        $arr_time   = [];
        for ($i = $begin; $i <= $end; $i->modify('+1 month'))
        {
            $date_format = $i->format('m/Y');
            $arr_time[]  = $date_format;
            foreach ($career_reports as $key => $career)
            {
                $month     = $career['month'];
                $year      = $career['year'];
                $career_id = $career['career_id'];
                $date      = (($month < 10) ? '0' . $month : $month) . '/' . $year;
                if ($date == $date_format)
                {
                    if (isset($arr_career[$career_id]['data'][$date_format]))
                    {
                        $arr_career[$career_id]['data'][$date_format] += $career['count'];
                    }
                    else
                    {
                        $arr_career[$career_id]['detail']             = [
                            'name' => $career['career_text']
                        ];
                        $arr_career[$career_id]['data'][$date_format] = $career['count'];
                    }
                }
                else
                {
                    if (!isset($arr_career[$career_id]['data'][$date_format]))
                    {
                        $arr_career[$career_id]['detail']             = [
                            'name' => $career['career_text']
                        ];
                        $arr_career[$career_id]['data'][$date_format] = 0;
                    }
                }
            }
        }

        //        dd($arr_career);
        return [
            'career_reports' => $arr_career,
            'times'          => $arr_time
        ];
    }

    private function transformReport($reports)
    {
        $data = [];
        foreach ($reports as $item)
        {
            $data[$item->career_id]['id']                  = $item->career_id;
            $data[$item->career_id]['name']                = $item->career_text;
            $data[$item->career_id]['report'][$item->time] = $item->total;
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
        $result = \DB::table('career_reports')
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
