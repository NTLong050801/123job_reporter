<?php
namespace Workable\RobotLog\Http\Controllers;
use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\RobotLog\Services\RobotVisitService;

class RobotVisitController extends AdminBaseController
{
    protected $viewPath = 'plugins.robot-log::robot_visit';
    protected $routeList = '';

    private $robotVisitService;

    public function __construct(RobotVisitService $robotVisitService
    )
    {
        parent::__construct();
        $this->robotVisitService = $robotVisitService;
    }

    public function index(Request $request)
    {
        $filterQuery = $this->__buildFilterQuery($request, 1);
        $filterQuery['order'] = [
            ['visited_at', 'desc'],
            ['bot', 'asc']
        ];
        $viewData = [
            "items" => $this->robotVisitService->getList($filterQuery, 100),
            "query" => $request->query()
        ];

        return view($this->viewPath.'.index')->with($viewData);
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
            'bot'        => $request->get('bot')
        ];

        return $filterQuery;
    }
}
