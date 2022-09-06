<?php

namespace Workable\Candidate\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Workable\Candidate\Services\CareerReportService;
use Workable\Candidate\Services\CareerService;
use Workable\Candidate\Services\DegreeReportService;
use Workable\Candidate\Services\RankReportService;

class ReportStaticController extends AdminBaseController
{
    protected $viewPath = 'plugins.candidate::pages.report_static';
    protected $routeList = '';

    private $careerReportService;
    private $rankReportService;
    private $degreeReportService;
    private $careerService;

    public function __construct(CareerReportService $careerReportService,
                                RankReportService $rankReportService,
                                CareerService $careerService,
                                DegreeReportService $degreeReportService)
    {
        parent::__construct();
        $this->careerReportService = $careerReportService;
        $this->rankReportService   = $rankReportService;
        $this->degreeReportService = $degreeReportService;
        $this->careerService       = $careerService;
    }

    /**
     * Note:
     * @param Request $request
     * @return Application|Factory|View
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function reportListCareer(Request $request)
    {
        $reports  = $this->careerReportService->getCareerReport($request);
        $dataView = [
            'reports' => $reports['reports'],
            'times'   => $reports['times'],
            'query'   => $request->query()
        ];

        return $this->renderView('list_career')->with($dataView);
    }

    /**
     * Note:
     * @param Request $request
     * @return Application|Factory|View
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function reportListRank(Request $request)
    {
        $reports  = $this->rankReportService->getRankReport($request);
        $dataView = [
            'reports' => $reports['reports'],
            'times'   => $reports['times'],
            'query'   => $request->query()
        ];

        return $this->renderView('list_rank')->with($dataView);
    }

    /**
     * Note:
     * @param Request $request
     * @return Application|Factory|View
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function reportListDegree(Request $request)
    {
        $reports  = $this->degreeReportService->getDegreeReport($request);
        $dataView = [
            'reports' => $reports['reports'],
            'times'   => $reports['times'],
            'query'   => $request->query()
        ];
        return $this->renderView('list_degree')->with($dataView);
    }


    /**
     * Note:
     * @param Request $request
     * @return Application|Factory|View
     * User: TranLuong
     * Date: 10/04/2021
     */
    public function reportChart(Request $request)
    {
        $top_careers = $this->careerReportService->getTopCareer($request);
        $careers     = $this->careerService->list($request);
        $dataView    = [
            'careers'     => $careers,
            'top_careers' => $top_careers
        ];

        return $this->renderView('chart')->with($dataView);
    }

    /**
     * Note:
     * @param Request $request
     * @return JsonResponse
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function reportChartCareer(Request $request): JsonResponse
    {
        $career_reports = $this->careerReportService->getCareerReportNew($request);

        return response()->json($career_reports);
    }

    /**
     * Note:
     * @param Request $request
     * @return JsonResponse
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function reportChartRank(Request $request): JsonResponse
    {
        $rank_reports = $this->rankReportService->getRankReportChart($request);

        return response()->json($rank_reports);
    }

    /**
     * Note:
     * @param Request $request
     * @return JsonResponse
     * User: TranLuong
     * Date: 10/04/2021
     * @throws \Exception
     */
    public function reportChartDegree(Request $request): JsonResponse
    {
        $degree_reports = $this->degreeReportService->getDegreeReportChart($request);

        return response()->json($degree_reports);
    }
}
