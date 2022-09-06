<?php
namespace Workable\ManagerSite\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminBaseController;
use Workable\ManagerSite\Services\ManagerSiteService;
use Workable\ManagerSite\Enum\SiteStatusEnum;
use Workable\ManagerSite\Http\Requests\ManagerSiteRequest;


class ManagerSiteBaseController extends AdminBaseController
{
    protected $viewPath = 'plugins.manager-site::pages';
    protected $routeList = 'get.manager-site.index';
    protected $managerSiteService;

    public function __construct(ManagerSiteService $managerSiteService)
    {
        parent::__construct();
        $this->managerSiteService = $managerSiteService;
    }

    public function index(Request $request)
    {
        $this->setFilter($request, 'site_name', 'LIKE');

        $filter = $this->getFilter();

        $viewData= [
            "items"=> $this->managerSiteService->list($filter),//data get database
            "status" => SiteStatusEnum::$statusText,
            "query"=>$request->query(),
        ];
        return $this->renderView('index')// return view('plugins.manager-site::pages.index')
            ->with($viewData);
    }

    public function create(){
        $viewData = [
            'item' => null,
            'status' => SiteStatusEnum::$statusText,
            'continents' => SiteStatusEnum::$continents,
        ];
        return $this->renderView('create')->with($viewData);
    }

    public function store(ManagerSiteRequest $request){
        $redirect = $request->get('redirect'); // return 0 hoac 1
//        dd($redirect);
        $data = $request->except(['_token', 'redirect']);//xoa _token , redirect ra khoi arr
        $this->managerSiteService->store($data); //send data siteService
        self::message("success", "Thêm thành công");

        return $this->redirect($redirect);
    }

    public function edit($id)
    {
        $viewData = [
            'item' => $this->managerSiteService->findById($id),
            'status' => SiteStatusEnum::$statusText,
            'continents' => SiteStatusEnum::$continents,
        ];
        //dd($viewData);
        return $this->renderView('edit')->with($viewData);
    }

    public function update($id, ManagerSiteRequest $request)
    {
        $this->managerSiteService->findById($id);
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->managerSiteService->update($id, $data);
        self::message("success", "Update thành công");
        return $this->redirect($redirect);
    }

    public function delete($id){
        $this->managerSiteService->delete($id);
        return $this->redirect(0);
    }
}
