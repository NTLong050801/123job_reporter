<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/10 - 23:30
 */

namespace Workable\ApplyJob\Http\Controllers;

use Illuminate\Http\Request;
use Workable\ApplyJob\Services\ApplyJobReportByAttributeService;
use Workable\ApplyJob\Services\ApplyJobReportByCategoryService;
use Workable\ApplyJob\Services\ApplyJobReportByLocationService;
use Workable\ApplyJob\Services\ApplyJobReportBySalaryService;

class ApplyJobReportController extends ApplyJobBaseController
{
    protected $viewPath = 'plugins.apply-job::';
    protected $routeList = '';


    protected $applyJobReportByLocationService;
    protected $applyJobReportByAttributeService;
    protected $applyJobReportByCategoryService;
    protected $jobReportBySalaryService;

    public function __construct(
                    ApplyJobReportByCategoryService $applyJobReportByCategoryService,
                    ApplyJobReportBySalaryService $jobReportBySalaryService,
                    ApplyJobReportByAttributeService $applyJobReportByAttributeService,
                    ApplyJobReportByLocationService $applyJobReportByLocationService)
    {
        $this->jobReportBySalaryService         = $jobReportBySalaryService;
        $this->applyJobReportByCategoryService  = $applyJobReportByCategoryService;
        $this->applyJobReportByAttributeService = $applyJobReportByAttributeService;
        $this->applyJobReportByLocationService  = $applyJobReportByLocationService;
    }

    /**
     * location
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * User: Hungokata
     * Date: 2021/06/13 - 09:26
     */
    public function location(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];

        $viewData = [
            "query" => $request->query(),
            "items" => $this->applyJobReportByLocationService->reportByLocation($filterQuery)
        ];

        return view($this->viewPath.'.location')->with($viewData);
    }


    /**
     * category
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * User: Hungokata
     * Date: 2021/06/13 - 09:27
     */
    public function category(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];

        $viewData = [
            "query" => $request->query(),
            "items" => $this->applyJobReportByCategoryService->reportByCategory($filterQuery)
        ];

        return view($this->viewPath.'.category')->with($viewData);
    }


    /**
     * salary
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * User: Hungokata
     * Date: 2021/06/13 - 09:27
     */
    public function salary(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];

        $viewData = [
            "query" => $request->query(),
            "items" => $this->jobReportBySalaryService->reportBySalary($filterQuery)
        ];

        return view($this->viewPath.'.salary')->with($viewData);
    }


    /**
     * attribute
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * User: Hungokata
     * Date: 2021/06/13 - 09:27
     */
    public function attribute(Request $request)
    {
        $viewData = [
            "query" => $request->query(),
            "items" => $this->applyJobReportByAttributeService->reportByAttribute()
        ];

        return view($this->viewPath.'.attribute')->with($viewData);
    }

}