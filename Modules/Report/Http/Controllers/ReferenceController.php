<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Modules\Report\Services\ReferenceService;
use Workable\ManagerSite\Enum\SiteStatusEnum;
use Workable\ManagerSite\Services\ManagerSiteService;
use Workable\Support\Traits\ResponseHelperTrait;

class ReferenceController extends AdminBaseController
{
    use ResponseHelperTrait;

    protected $viewPath = 'report::pages';
    protected $siteService;
    protected $referenceService;

    public function __construct(
        ManagerSiteService $siteService,
        ReferenceService    $referenceService
    )
    {
        $this->siteService = $siteService;
        $this->referenceService = $referenceService;
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

        return view('report::pages.reference.index')->with($viewData);
    }


    public function getDataForChart(Request $request)
    {
        $site_id = $request->get('site_id');
        $day = $request->get('day',30) ?? 30;

        $datas = $this->referenceService->getList($site_id);
        $dataTransForm = $this->referenceService->getDataForChart($datas,$day);

        return $this->respondSuccess($message = 'success', $data = $dataTransForm, $type='success');
    }



}
