<?php

namespace Workable\Employee\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

use Workable\AuditLog\Facades\AuditLogFacade;
use Workable\Employee\Http\Requests\AdminRequest;
use Workable\Employee\Http\Requests\PasswordRequest;
use Workable\Employee\Services\EmployeeService;
use Workable\Organization\Services\CompanyService;
use Workable\Employee\Enum\AdminEnum;
use Workable\Employee\Models\Admin;

class EmployeeController extends AdminBaseController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $employeeService;
    protected $companyService;
    protected $viewPath  = 'plugins.employee::employee';
    protected $routeList = 'get.employee.index';

    public function __construct(
        EmployeeService $employeeService,
        CompanyService $companyService
    ) {
        parent:: __construct();
        $this->employeeService = $employeeService;
        $this->companyService  = $companyService;
    }

    /**
     * Nhân sự đi làm
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->setFilter($request, 'name', 'LIKE');
        $this->setOrder($request, 'id', 'desc');
        $filter   = $this->getFilter();
        $viewData = [
            'users' => $this->employeeService->list($filter),
            'query' => $request->query(),
            // 'roles' => $this->employeeService->listAdminRole(),
        ];

        return $this->renderView('index')->with($viewData);
    }

    /**
     * Nhân sự đã nghỉ việc
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function end(Request $request)
    {
        $this->setFilter($request, 'name', 'LIKE');
        $this->setFilter($request, 'active', '=', AdminEnum::STATUS_INACTIVE);
        $this->setOrder($request, 'id', 'desc');
        $filter   = $this->getFilter();
        $viewData = [
            'users' => $this->employeeService->list($filter),
            'query' => $request->query(),
            // 'roles' => $this->employeeService->listAdminRole(),
        ];
        return $this->renderView('end')->with($viewData);
    }

    public function create()
    {
        $viewData = [
            'roles'     => $this->employeeService->listRoles(),
            'companies' => $this->companyService->listChildLevel(),
        ];
        return $this->renderView('create')->with($viewData);
    }

    public function store(AdminRequest $request)
    {
        $redirect       = $request->get('redirect');
        $data           = $request->except(['_token', '_method', 'redirect']);
        $data['id']     = $this->employeeService->insert($data);
        AuditLogFacade:: screen("employee")
            ->request($request)
            ->data((object)$data)
            ->created();

        self:: message("success", "Thêm thành công");
        return $this->redirect($redirect);
    }

    public function edit($id)
    {
        $viewData = [
            'roles'     => $this->employeeService->listRoles(),
            'user'      => $this->employeeService->findUser($id),
            'companies' => $this->companyService->listChildLevel(),
        ];
        return $this->renderView('edit')->with($viewData);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return
     */
    public function update(AdminRequest $request, $id)
    {
        $employee = $this->employeeService->findUser($id);
        $data     = $request->except(['_token', '_method', 'redirect']);
        $this->employeeService->update($id, $data);
        // $this->employeeService->updateAdminRole($request->role, $id);
        AuditLogFacade:: screen("employee")
            ->request($request)
            ->data($employee)
            ->updated();

        self:: message("success", "Update thành công");
        return redirect('/hrm/employee/index');
    }

    public function editPwd($id)
    {
        $viewData = [
            'user' => $this->employeeService->findUser($id),
        ];
        return view('plugins.employee::password.change_password')->with($viewData);
    }

    public function updatePwd(PasswordRequest $request, $id)
    {
        $user = $this->employeeService->findUser($id);
        if (!Hash::check($request->oldPwd, $user->password)) {
            return Redirect:: back()->withErrors(["oldPwd" => "Wrong password"]);
        }
        if ($request->newPwd != $request->rePwd) {
            return Redirect:: back()->withErrors(["rePwd" => "Wrong re-enter new password"]);
        }
        $user->password = Hash::make($request->newPwd);
        $user->save();
        self:: message("success", "Update mật khẩu thành công");
        return redirect('/hrm/employee/index');
    }

    public function updateStatus(Request $request, $id)
    {
        if ($id == 1) {
            self:: message("warning", "Bạn không thể khóa tài khoản quản trị viên");
            return $this->redirect($this->routeList);
        }

        $user         = Admin::find($id);
        $user->active = $user->active == AdminEnum::STATUS_INACTIVE ? AdminEnum::STATUS_ACTIVE : AdminEnum::STATUS_INACTIVE;
        $user->save();

        return redirect('/hrm/employee/index');
    }

    public function fakeLogin($id)
    {
        Auth:: guard('admins')->loginUsingId($id, true);
        return redirect('/company');
    }

    public function searchAjax(Request $request)
    {
        $this->setFilter($request, 'name', 'LIKE');
        $filter = $this->getFilter();
        $items = $this->employeeService->list($filter);
        return json_encode( $items->toArray()['data'] );
    }
}
