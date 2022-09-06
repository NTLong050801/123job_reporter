<?php
namespace Workable\ApplyJob\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;
use Workable\ApplyJob\Services\ApplyJobSourceService;

class ApplyJobOverviewController extends AdminBaseController
{
    protected $viewPath = 'plugins.apply-job::';
    protected $routeList = '';

    protected $applyJobSourceService;

    public function __construct(ApplyJobSourceService $applyJobSourceService)
    {
        $this->applyJobSourceService = $applyJobSourceService;
    }

    public function overview(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];
        $viewData = [
            "items" => $this->applyJobSourceService->overview($filterQuery),
            "query" => $request->query()
        ];
        return view($this->viewPath.'.overview')->with($viewData);
    }

    public function byMonth(Request $request)
    {
        $viewData = [
            "items" => $this->applyJobSourceService->overviewMonth(),
            "query" => $request->query()
        ];


        return view($this->viewPath.'.overview_month')->with($viewData);
    }
}
