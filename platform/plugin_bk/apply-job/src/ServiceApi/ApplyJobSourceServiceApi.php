<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/07/29 - 15:50
 */
namespace Workable\ApplyJob\ServiceApi;

use Workable\ApplyJob\Repository\ApplyJobSourceRepository;
use Workable\ApplyJob\Utils\ApplyReportUtil;

class ApplyJobSourceServiceApi
{
    /**
     * @var ApplyJobSourceRepository
     */
    protected $applyJobSourceRepository;

    /**
     * @var ApplyReportUtil
     */
    protected $applyReportUtil;

    public function __construct(ApplyJobSourceRepository $applyJobRepository)
    {
         $this->applyJobSourceRepository = $applyJobRepository;
        $this->applyReportUtil          = new ApplyReportUtil();
    }

    public function report($filterQuery = [])
    {
        $start = microtime(true);
        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = \Carbon\Carbon::createFromFormat('Y-m-d', $times['start'])->startOfDay()->toDateTimeString();
            $filter['end_time'] = \Carbon\Carbon::createFromFormat('Y-m-d', $times['end'])->endOfDay()->toDateTimeString();
        }
        else
        {
            $filter['start_time'] = now()->startOfDay()->toDateTimeString();
            $filter['end_time']   = now()->endOfDay()->toDateTimeString();
        }

        $items  = $this->applyJobSourceRepository->getListForDay($filter);
        $items  = $items->toArray();
        $result = $this->applyReportUtil->transformItems($items, $filter);

        $end     = microtime(true);
        $execute = ($end-$start) * 1000 . 'ms';

        return [
            "result" => $result,
            'query' => $filter,
            "time" => $execute
        ];
    }
}