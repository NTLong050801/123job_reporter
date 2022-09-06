<?php

namespace Modules\Company\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Modules\Company\Http\Requests\ModuleRequest;
use Modules\Company\Services\ModuleService;

class ModuleController extends AdminBaseController
{
    protected $moduleService;
    protected $viewPath = 'company::pages.module';
    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function index()
    {
        $modules = $this->moduleService->list();
        $module = [];
        $submodules= [];
        foreach($modules as $item){
            if($item->parent_id==0){
                array_push( $module, $item);
            }
            else{
                array_push($submodules, $item);
            }
        }
        $viewData = [
            'modules' =>$module,
            'submodules' => $submodules
        ];
        return $this->renderView('index')->with($viewData);
    }

    public function sort()
    {
        $filter= [['menu_id', '=', 1], ['show_sidebar', '=', 1]];
        $modules = $this->moduleService->list($filter);
        $module = [];
        $submodules= [];
        foreach($modules as $item){
            if($item->parent_id==0){
                array_push( $module, $item);
            }
            else{
                array_push($submodules, $item);
            }
        }
        $viewData = [
            'menus' => $this->moduleService->listMenu(),
            'modules' =>$module,
            'submodules' => $submodules
        ];
        return $this->renderView('sort')->with($viewData);
    }

    public function ajaxGetMenu($id)
    {
        $filter= [['menu_id', '=', $id], ['show_sidebar', '=', 1]];
        return $this->moduleService->list($filter);
    }

    public function ajaxUpdateModuleOrder(Request $request)
    {
        $req = $request->get('obj', []);
        $this->moduleService->updateModuleOrder($req);
        return response()->json(['success' => 'Sắp xếp thành công!']);
    }

    public function edit($id)
    {
        $viewData = [
            'module'=> $this->moduleService->find($id),
        ];
        return $this->renderView('edit')->with($viewData);
    }

    public function update(ModuleRequest $request, $id)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', '_method']);
        $this->moduleService->update($id, $data);
        self::message('info', 'Update thành công');
        return $this->redirect($redirect);
    }
}
