<?php
namespace Workable\ReferenceSite\Http\Controllers;
use Illuminate\Http\Request;
use Workable\ReferenceSite\Services\JobReferSourceReportOverviewService;


class ReferenceSiteReportByDayController extends ReferenceSiteBaseController
{
    protected $viewPath = 'plugins.reference-site::';
    protected $routeList = '';

    protected $jobReferSourceReportOverviewService;

    public function __construct(JobReferSourceReportOverviewService $jobReferSourceReportOverviewService)
    {
        $this->jobReferSourceReportOverviewService = $jobReferSourceReportOverviewService;
    }

    /**
     * byDay
     * @param Request $request
     * User: Hungokata
     * Date: 2021/06/06 - 23:48
     */
    public function overview(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];

        $viewData = [
            "items" => $this->jobReferSourceReportOverviewService->reportByDay($filterQuery),
            'query' => $request->query()
        ];

        return view($this->viewPath.'.overview.index')->with($viewData);
    }

    public function byMonth(Request $request)
    {
        $dateRange = $request->get('month_range');
        $filterQuery = [
            'month_range' => $dateRange
        ];

        $viewData = [
            "items" => $this->jobReferSourceReportOverviewService->reportByMonth($filterQuery),
            'query' => $request->query()
        ];

        return view($this->viewPath.'.overview.month')->with($viewData);
    }
}
