<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/11 - 10:15
 */

namespace Workable\SubscribeJob\Http\Controllers;


use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\SubscribeJob\Services\SubscribeJobService;
use Workable\SubscribeJob\Services\SubscribeJobSourceService;


class SubscribeJobOverviewController extends AdminBaseController
{
    protected $viewPath = 'plugins.subscribe-job::';
    protected $routeList = '';

    /**
     * @var SubscribeJobService
     */
    protected $subscribeJobSourceService;

    public function __construct(SubscribeJobSourceService $subscribeJobSourceService)
    {
        $this->subscribeJobSourceService = $subscribeJobSourceService;
    }

    public function overview(Request $request)
    {
        $filter = [
            "date_range" => $request->get("date_range")
        ];

        $viewData = [
            'query' => $request->query(),
            "items" => $this->subscribeJobSourceService->reportOverview($filter)
        ];
        return view($this->viewPath.'overview')->with($viewData);
    }

    public function overviewMonth(Request $request)
    {
        $filter = [

        ];
        $viewData = [
            'query' => $request->query(),
            "items" => $this->subscribeJobSourceService->reportMonth($filter)
        ];
        return view($this->viewPath.'overview_month')->with($viewData);
    }

}