<?php
namespace Workable\GoogleLog\Http\Controllers;
use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\GoogleLog\Services\ClientEventService;
use Workable\GoogleLog\Services\GoogleLogService;

class GoogleAnalyticController extends AdminBaseController
{
    protected $viewPath = 'plugins.google-log::google_analytic';
    protected $routeList = '';

    private $googleLogService;
    private $clientEventService;

    public function __construct(GoogleLogService $googleLogService,
                                ClientEventService $clientEventService)
    {
        parent::__construct();
        $this->googleLogService   = $googleLogService;
        $this->clientEventService = $clientEventService;
    }

    public function indexUser(Request $request)
    {
        $filterQuery = $this->__buildFilterQuery($request);
        $filterQuery['order'] = [
            ['source_created_at', 'desc'],
            ['log_int', 'asc'],
        ];
        $viewData = [
            "data"  => $this->googleLogService->getList($filterQuery),
            "query" => $request->query()
        ];
        return view($this->viewPath.'.user')->with($viewData);
    }

    public function indexUserChart(Request $request)
    {
        $filterQuery = $this->__buildFilterQuery($request, 6);
        $filterQuery['order'] = [
            ['source_created_at', 'asc'],
            ['log_int', 'asc'],
        ];
        $viewData = [
            "data"  => $this->googleLogService->getDataForChart($filterQuery),
            "query" => $request->query()
        ];

        return view($this->viewPath.'.user_chart')->with($viewData);
    }

    public function indexEvent(Request $request)
    {
        $filterQuery = $this->__buildFilterQuery($request);
        $filterQuery['order'] = [
            ['source_created_at', 'desc'],
            ['event_int', 'asc'],
        ];
        $viewData = [
            "data"  => $this->clientEventService->getList($filterQuery),
            "query" => $request->query()
        ];

        return view($this->viewPath.'.event')->with($viewData);
    }

    public function indexEventChart(Request $request)
    {
        $filterQuery = $this->__buildFilterQuery($request, 6);
        $filterQuery['order'] = [
            ['source_created_at', 'asc'],
            ['event_int', 'asc'],
        ];
        $viewData = [
            "data"  => $this->clientEventService->getDataForChart($filterQuery),
            "query" => $request->query()
        ];

        return view($this->viewPath.'.event_chart')->with($viewData);
    }

    private function __buildFilterQuery(Request $request, $lastDay = 0)
    {
        $dateRange = $request->get('date_range');
        if(!$dateRange)
        {
            $today     = now()->format('d/m/Y');
            if($lastDay)
            {
                $firstDay  = now()->subDays($lastDay)->format('d/m/Y');
            }
            else {
                $thisMonth = now()->format('m/Y');
                $firstDay  = '01/' . $thisMonth;
            }
            $dateRange = $firstDay . ' - ' . $today;
            $request->merge(['date_range' => $dateRange]);
        }
        $filterQuery = [
            'date_range' => $dateRange,
            'label_page' => $request->get('label_page'),
            'path'       => $request->get('path'),
            'app_int'    => $request->get('app_int') ?? 1,
        ];

        return $filterQuery;
    }
}
