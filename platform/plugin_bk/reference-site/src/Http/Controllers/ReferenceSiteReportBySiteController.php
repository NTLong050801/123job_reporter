<?php
namespace Workable\ReferenceSite\Http\Controllers;
use Illuminate\Http\Request;
use Workable\ReferenceSite\Services\JobReferReportByCategoryService;
use Workable\ReferenceSite\Services\JobReferReportByCityService;
use Workable\ReferenceSite\Services\JobReferReportBySalaryService;
use Workable\ReferenceSite\Services\JobReferReportByWebsiteService;

class ReferenceSiteReportBySiteController extends ReferenceSiteBaseController
{
    protected $viewPath = 'plugins.reference-site::';
    protected $routeList = '';

    protected $jobReferReportByWebsiteService;
    protected $jobReferReportBySalaryService;
    protected $jobReferReportByCityService;
    protected $jobReferReportByCategoryService;

    public function __construct(
            JobReferReportByWebsiteService $jobReferReportByWebsiteService,
            JobReferReportBySalaryService $jobReferReportBySalaryService,
            JobReferReportByCityService $jobReferReportByCityService,
            JobReferReportByCategoryService $jobReferReportByCategoryService
    )
    {
        $this->jobReferReportByWebsiteService  = $jobReferReportByWebsiteService;
        $this->jobReferReportBySalaryService   = $jobReferReportBySalaryService;
        $this->jobReferReportByCityService     = $jobReferReportByCityService;
        $this->jobReferReportByCategoryService = $jobReferReportByCategoryService;
    }

    /**
     * bySite
     * @param Request $request
     * User: Hungokata
     * Date: 2021/06/06 - 23:48
     */
    public function bySite(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];

        $viewData = [
            'items' => $this->jobReferReportByWebsiteService->reportByTime($filterQuery),
            'query' => $request->query()
        ];
        return view($this->viewPath.'.by_site.index')->with($viewData);
    }

    /**
     * bySite
     * @param Request $request
     * User: Hungokata
     * Date: 2021/06/06 - 23:48
     */
    public function byCategory(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];

        $viewData = [
            'items' => $this->jobReferReportByCategoryService->reportByTime($filterQuery),
            'query' => $request->query()
        ];
        return view($this->viewPath.'.by_category.index')->with($viewData);
    }

    /**
     * bySite
     * @param Request $request
     * User: Hungokata
     * Date: 2021/06/06 - 23:48
     */
    public function byLocation(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];

        $viewData = [
            'items' => $this->jobReferReportByCityService->reportByTime($filterQuery),
            'query' => $request->query()
        ];
        return view($this->viewPath.'.by_location.index')->with($viewData);
    }

    /**
     * bySite
     * @param Request $request
     * User: Hungokata
     * Date: 2021/06/06 - 23:48
     */
    public function bySalary(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];
        $viewData = [
            'items' => $this->jobReferReportBySalaryService->reportByTime($filterQuery),
            'query' => $request->query()
        ];
        return view($this->viewPath.'.by_salary.index')->with($viewData);
    }
}
