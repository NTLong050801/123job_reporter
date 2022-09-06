<?php


namespace Workable\Organization\Http\Controllers;


use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Workable\Base\Supports\CliEcho;
use Workable\Employee\Services\EmployeeService;
use Workable\FileUploader\Core\Exceptions\UploadFileException;
use Workable\Organization\Enum\AnnouncementStatusEnum;
use Workable\Organization\Enum\AnnouncementTypeEnum;
use Workable\Organization\Http\Requests\AnnouncementRequest;
use Workable\Organization\Services\AnnouncementService;
use Workable\Organization\Services\CompanyService;

class AnnouncementController extends AdminBaseController
{
    protected $viewPath = 'plugins.organization::pages.announcement';

    protected $announcementService;
    protected $companyService;
    protected $employeeService;

    public function __construct(AnnouncementService $announcementService,
                                CompanyService $companyService,
                                EmployeeService $employeeService)
    {
        parent::__construct();
        $this->announcementService = $announcementService;
        $this->companyService = $companyService;
        $this->employeeService = $employeeService;
    }

    public function index(Request $request)
    {
        $this->setFilter($request, 'id', '=');
        $this->setFilter($request, 'name', 'LIKE');
        $this->setFilter($request, 'company_id', '=');
        $this->setFilter($request, 'type', '=');
        $this->setFilter($request, 'status', '=');
        $this->setFilter($request, 'admin_id', '=');
        $filter = $this->getFilter();
        $filter[] = ['status', '=', AnnouncementStatusEnum::STATUS_SHOW];
        $items = $this->announcementService->list($filter);
        $list_birth_day = $this->employeeService->getAll([
            ['date_of_birth', 'LIKE', '%' . date_format(now(), "m-d") . '%'],
        ]);
        $viewData = [
            'items' => $items,
            'list_birth_day' => $list_birth_day,
            'query' => $request->query()
        ];
        return $this->renderView('index')->with($viewData);
    }

    public function indexHide(Request $request)
    {
        $this->setFilter($request, 'id', '=');
        $this->setFilter($request, 'name', 'LIKE');
        $this->setFilter($request, 'company_id', '=');
        $this->setFilter($request, 'type', '=');
        $this->setFilter($request, 'status', '=');
        $this->setFilter($request, 'admin_id', '=');
        $filter = $this->getFilter();
        $filter[] = ['status', '=', AnnouncementStatusEnum::STATUS_HIDE];
        $items = $this->announcementService->list($filter);
        $list_birth_day = $this->employeeService->getAll([
            ['date_of_birth', 'LIKE', '%' . date_format(now(), "m-d") . '%'],
        ]);
        $viewData = [
            'items' => $items,
            'list_birth_day' => $list_birth_day,
            'query' => $request->query()
        ];
        return $this->renderView('index')->with($viewData);
    }

    public function edit($id)
    {
        $item = $this->announcementService->findById($id);
        $viewData = [
            'item' => $item,
            'companies' => $this->companyService->listChildLevel(),
            'type' => AnnouncementTypeEnum::$statusText,
            'status' => AnnouncementStatusEnum::$statusText
        ];
        return $this->renderView('edit')->with($viewData);
    }

    public function update($id, AnnouncementRequest $request)
    {
//        dd('ok');
        $item = $this->announcementService->findById($id);
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->announcementService->update($item->id, $data);

        self::message('success', "Cập nhật thành công");
        return $this->redirect($redirect);
    }

    public function create()
    {
        $viewData = [
            'companies' => $this->companyService->listChildLevel(),
            'type' => AnnouncementTypeEnum::$statusText,
            'status' => AnnouncementStatusEnum::$statusText
        ];
        return $this->renderView('create')->with($viewData);
    }

    public function store(AnnouncementRequest $request)
    {
        $redirect = $request->get('redirect');
        $data = $request->except(['_token', 'redirect']);
        $this->announcementService->insert($data);

        self::message('success', "Thêm thành công thông báo");
        return $this->redirect($redirect);
    }

    public function uploadImageContent(Request $request)
    {
        $CKEditorFuncNum = $request->CKEditorFuncNum;
        try {
            $config = config('packages.file-uploader.upload_image.attach');
            $results = app("image-uploader")->setConfig($config)->upload('upload');
            $url = parse_url_file($results->toArray()['file_name'], 'uploads');
            $message = '';

            $viewData = [
                'CKEditorFuncNum' => $CKEditorFuncNum,
                'data' => [
                    'url' => $url,
                    'message' => $message,
                ],
            ];

            return $this->renderView('preview_image_upload')->with($viewData);
        } catch (UploadFileException $e) {
            CliEcho::errornl($e->info());
            $results = null;
            return $results;
        }
    }

    public function show($id)
    {
        $item = $this->announcementService->findById($id);
        $this->announcementService->update($id, ['views' => $item->views + 1]);
        $list_birth_day = $this->employeeService->getAll([
            ['date_of_birth', '<', now()->modify('+3 day')],
            ['date_of_birth', '>', now()],
        ]);
        $viewData = [
            'item' => $item,
            'new_items' => $this->announcementService->newList(),
            'list_birth_day' => $list_birth_day,
        ];
        return $this->renderView('show')->with($viewData);
    }


    /**
     * @param $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($redirect)
    {
        switch ($redirect) {
            case 0:
                return redirect()->back();
                break;

            case 1:
                return redirect()->route('get.announcement.index');
                break;
        }
    }
}
