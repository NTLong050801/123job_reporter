<?php

namespace Modules\Monitor\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Monitor\Enum\MonitorEnum;
use Modules\Monitor\Enum\MonitorMethodCheckEnum;
use Modules\Monitor\Http\Requests\CreateMonitorRequest;
use Modules\Monitor\Service\MonitorService;
use Workable\ManagerSite\Services\ManagerSiteService;

class MonitorController extends AdminBaseController
{

    protected $viewPath = 'monitor::pages';
    protected $siteService;
    protected $monitorService;

    public function __construct(
        ManagerSiteService $siteService,
        MonitorService     $monitorService
    )
    {
        $this->siteService = $siteService;
        $this->monitorService = $monitorService;
    }

    public function dashBoard()
    {

        $up_total = count(DB::table('monitors')->where('uptime_status','=', 'Up')->get());
        $pause_total = count(DB::table('monitors')->where('uptime_status','=' ,'Pause')->get());
        $down_total = count(DB::table('monitors')->where('uptime_status','=' ,'Down')->get());
        $total = $up_total + $pause_total + $down_total;

        $viewData = [
            'up_total' => $up_total,
            'pause_total' => $pause_total,
            'down_total' => $down_total,
            'total'    => $total
        ];

        return view('monitor::pages.monitor.dashboard')->with($viewData);
    }

    public function index(Request $request)
    {
        $this->setFilter($request, 'uptime_check_enabled', '=');
        $this->setFilter($request, 'certificate_check_enabled', '=');
        $this->setFilter($request, 'site_id', '=');
        $this->setFilter($request, 'uptime_status', '=');

        $filter = $this->getFilter();

        $items = $this->monitorService->getList($filter);
        $sites = $this->siteService->getSiteActive($filter = '');
        $viewData = [
            'items' => $items,
            'sites' => $sites,
            'status' => MonitorEnum::$statusText
        ];

        return view('monitor::pages.monitor.index')->with($viewData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $tab_active = $request->get('tab') ?? 'basic';
        $sites = $this->siteService->getSiteActive($filter = '');

        $viewData = [
            'sites' => $sites,
            'tab_active' => $tab_active,
            'uptime_check_methods' => MonitorMethodCheckEnum::$methodCheck,
            'checkers' => MonitorEnum::$responseChecker,
        ];

        return view('monitor::pages.monitor.create')->with($viewData);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateMonitorRequest $request)
    {

        $redirect = $request->get('redirect');
        $this->monitorService->insert($request);

        self::message('success', 'Thêm thành công');
        return $this->redirect($redirect);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('report::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $item = $this->monitorService->finById($id);
        $sites = $this->siteService->getSiteActive($filter = '');
        $tab_active = $request->get('tab') ?? 'basic';
        $viewData = [
            'item' => $item,
            'sites' => $sites,
            'tab_active' => $tab_active,
            'uptime_check_methods' => MonitorMethodCheckEnum::$methodCheck,
            'checkers' => MonitorEnum::$responseChecker,
        ];

        return view('monitor::pages.monitor.edit')->with($viewData);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CreateMonitorRequest $request, $id)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->monitorService->update($request, $id, $data);
        self::message('info', 'update thành công');

        return $this->redirect($redirect);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->monitorService->delete($id);

        self::message('info', 'Xóa thành công');

        return redirect()->back();
    }

    protected function redirect($redirect)
    {
        switch ($redirect) {
            case 0 :
                return redirect()->back();
                break;
            case 1 :
                return redirect()->route('get.monitor.index');
                break;

        }

    }
}
