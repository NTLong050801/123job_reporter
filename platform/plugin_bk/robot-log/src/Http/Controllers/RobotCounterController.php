<?php
namespace Workable\RobotLog\Http\Controllers;
use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\RobotLog\Services\RobotCounterService;

class RobotCounterController extends AdminBaseController
{
    protected $viewPath = 'plugins.robot-log::robot_counter';
    protected $routeList = '';

    private $robotCounterService;

    public function __construct(RobotCounterService $robotCounterService
    )
    {
        parent::__construct();
        $this->robotCounterService = $robotCounterService;
    }

    public function indexByDay(Request $request)
    {
        $filterQuery = $this->__buildFilterQuery($request, 6);
        $filterQuery['order'] = [
            ['date', 'desc'],
        ];
        $viewData = [
            "items" => $this->robotCounterService->getList($filterQuery, 50),
            "query" => $request->query()
        ];

        return view($this->viewPath.'.by_day')->with($viewData);
    }

    public function indexChart(Request $request)
    {
        $filterQuery = $this->__buildFilterQuery($request, 6);
        $filterQuery['order'] = [
            ['date', 'asc'],
            ['bot', 'asc']
        ];
        $viewData = [
            "data"  => $this->robotCounterService->getDataForChart($filterQuery),
            "query" => $request->query()
        ];

        return view($this->viewPath.'.chart')->with($viewData);
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
