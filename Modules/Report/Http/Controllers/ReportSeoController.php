<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Report\Services\ReportSeoService;
use Workable\ManagerSite\Enum\SiteStatusEnum;
use Workable\ManagerSite\Services\ManagerSiteService;
use Workable\Support\Traits\ResponseHelperTrait;

class ReportSeoController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    use ResponseHelperTrait;

    protected $viewPath = 'report::pages';
    protected $siteService;
    protected $reportSeoService;

    public function __construct(
        ManagerSiteService $siteService,
        ReportSeoService $reportSeoService
    )
    {
        $this->siteService = $siteService;
        $this->reportSeoService = $reportSeoService;
    }

    public function index(Request $request)
    {
        $this->setFilter($request,'site_name','LIKE');
        $this->setFilter($request,'continent','LIKE');
        $filter= $this->getFilter();
        $sites = $this->siteService->getSiteActive($filter);

        $viewData = [
            'sites' => $sites,
            'continents' => SiteStatusEnum::$continents,
            'request' => $request->all(),
            'query' =>$request->query()
        ];

        return view('report::pages.seo_content.index')->with($viewData);
    }

    public function getDataForChart(Request $request) {
        $site_id = $request->get('site_id');
        $day = $request->get('day',30) ?? 30;

        $datas = $this->reportSeoService->getList($site_id);
        $dataTransForm = $this->reportSeoService->getDataForChart($datas,$day);

        return $this->respondSuccess($message = 'success', $data = $dataTransForm, $type='success');

    }





}
