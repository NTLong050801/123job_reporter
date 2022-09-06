<?php

namespace Workable\Candidate\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Workable\Candidate\Services\CandidateService;
use Workable\Candidate\Services\CareerService;
use Workable\Candidate\Services\CVReportService;
use Workable\Candidate\Services\DegreeReportService;
use Workable\Candidate\Services\RankReportService;

class ReportCvController extends AdminBaseController
{
    protected $viewPath = 'plugins.candidate::pages.report_cv';
    protected $routeList = '';

    private $CVReportService;
    private $candidateService;
    private $careerService;
    private $rankReportService;
    private $degreeReportService;

    public function __construct(CVReportService $CVReportService,
                                CandidateService $candidateService,
                                CareerService $careerService,
                                RankReportService $rankReportService,
                                DegreeReportService $degreeReportService)
    {
        parent::__construct();
        $this->CVReportService     = $CVReportService;
        $this->candidateService    = $candidateService;
        $this->careerService       = $careerService;
        $this->rankReportService   = $rankReportService;
        $this->degreeReportService = $degreeReportService;
    }

    /**
     * Note:
     * @param Request $request
     * @return Application|Factory|View
     * User: TranLuong
     * Date: 09/04/2021
     */
    public function reportAmount(Request $request)
    {
        $cv_reports = $this->CVReportService->list($request);
        $dataView   = [
            'cv_reports' => $cv_reports,
            'query'      => $request->query(),
        ];

        return $this->renderView('amount')->with($dataView);
    }

    /**
     * Note:
     * @param Request $request
     * @return Application|Factory|View
     * User: TranLuong
     * Date: 09/04/2021
     */
    public function reportList(Request $request)
    {
        $ranks      = $this->rankReportService->getListRankDistinct();
        $degrees    = $this->degreeReportService->getListRankDistinct();
        $careers    = $this->careerService->list($request);
        $candidates = $this->candidateService->list($request);
        $dataView   = [
            'candidates' => $candidates,
            'careers'    => $careers,
            'ranks'      => $ranks,
            'degrees'    => $degrees,
            'query'      => $request->query(),
        ];

        return $this->renderView('list')->with($dataView);
    }

    /**
     * Hiển thị chi tiết ứng viên
     * @param Request $request
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function detail(Request $request)
    {
        $id                   = $request->get('id');
        $candidate            = \DB::table('candidates')->where('id', $id)->first();
        $candidate->meta_info = $candidate->meta_info ? json_decode($candidate->meta_info, true) : null;
        $candidate->school    = $candidate->school ? json_decode($candidate->school, true) : [];
        $candidate->company   = $candidate->company ? json_decode($candidate->company, true) : [];
        $viewData             = [
            'candidate' => $candidate
        ];

        return response([
            'html' => view('plugins.candidate::components.modal.candidate_detail')->with($viewData)->render(),
        ]);
    }
}
