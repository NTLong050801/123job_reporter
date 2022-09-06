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

class SubscribeJobReportController extends AdminBaseController
{
    protected $viewPath = 'plugins.subscribe-job::pages.';
    protected $routeList = '';


    /**
     * @var SubscribeJobService
     */
    protected $subscribeJobService;

    public function __construct(SubscribeJobService $subscribeJobService)
    {
        $this->subscribeJobService = $subscribeJobService;
    }

    public function location(Request $request)
    {
        $viewData = [
            'query' => $request->query(),
            'items' => $this->subscribeJobService->reportByLocation($request->query())
        ];

        return view($this->viewPath.'location')->with($viewData);
    }

    public function salary(Request $request)
    {
        $viewData = [
            'query' => $request->query(),
            'items' => $this->subscribeJobService->reportBySalary($request->query())
        ];

        return view($this->viewPath.'salary')->with($viewData);
    }

    public function position(Request $request)
    {
        $viewData = [
            'query' => $request->query(),
            'items' => $this->subscribeJobService->reportBySource($request->query())
        ];

        return view($this->viewPath.'position')->with($viewData);
    }

    public function attribute(Request $request)
    {
        $viewData = [
            'query' => $request->query()
        ];

        return view($this->viewPath.'attribute')->with($viewData);
    }
}