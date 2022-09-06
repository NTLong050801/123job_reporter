<?php

namespace Workable\Candidate\Services;

use Illuminate\Http\Request;
use Workable\Candidate\Repository\CVReport\CVReportRepositoryInterface;

class CVReportService
{
    protected $CVReportRepository;

    public function __construct(CVReportRepositoryInterface $CVReportRepository)
    {
        $this->CVReportRepository = $CVReportRepository;
    }

    /**
     * Note:
     * @param Request $request
     * @return mixed
     * User: TranLuong
     * Date: 09/04/2021
     */
    public function list(Request $request)
    {
        $param = [
            'month_range' => $request->get('month_range'),
            'source'      => $request->get('source'),
            'order'       => [['timestamp', 'asc']]
        ];

        $filter = [
            ['source_int', "=", $request->get('source')],
        ];

        $this->CVReportRepository->setParam($param);

//        return $this->CVReportRepository->list($filter, ['date', 'total']);

        return $this->CVReportRepository->statistic();
    }
}
