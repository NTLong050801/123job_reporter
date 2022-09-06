<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Modules\Report\Services\ReportSeoService;
use Modules\Report\Services\UploadService;
use Workable\ManagerSite\Enum\SiteStatusEnum;
use Workable\ManagerSite\Services\ManagerSiteService;
use Workable\Support\Traits\ResponseHelperTrait;

class UploadPublicController extends AdminBaseController
{
    use ResponseHelperTrait;

    protected $viewPath = 'report::pages';
    protected $siteService;
    protected $uploadService;
    protected $reportSeoService;

    public function __construct(
        ManagerSiteService $siteService,
        UploadService      $uploadService,
        ReportSeoService   $reportSeoService
    )
    {
        $this->siteService = $siteService;
        $this->uploadService = $uploadService;
        $this->reportSeoService = $reportSeoService;
    }
    public function index(Request $request)
    {
        $this->setFilter($request, 'site_name', 'LIKE');
        $filter = $this->getFilter();
        $sites = $this->siteService->getSiteActive($filter);
//        dd($sites);
        $viewData = [
            'sites' => $sites,
            'request' => $request->all(),
            'continents' => SiteStatusEnum::$continents,
            'query' =>$request->query()
        ];

        return view('report::pages.upload.index')->with($viewData);
    }

    public function getDataForChart(Request $request)
    {
//        $site_id = $request->get('site_id');
        $site_id = 2;
        $day = $request->get('day', 30) ?? 30;
        $datas = $this->uploadService->getList($site_id);
        $dataTransForm = $this->uploadService->getDataForChart($datas, $day);
        dd($datas);
        return $this->respondSuccess($message = 'success', $data = $dataTransForm, $type = 'success');
    }

}
