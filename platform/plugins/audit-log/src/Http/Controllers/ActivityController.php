<?php

namespace Workable\AuditLog\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Response;
use Workable\AuditLog\Services\ActivityService;

class ActivityController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected  $activityService;
    protected $viewPath = 'plugins.audit-log::activity';

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function active()
    {
        $filter   = $this->getFilter();
        $sort     = [['id', 'desc']];
        $viewData = [
            'users' => $this->activityService->list($filter, $sort),
        ];
        return $this->renderView('index')->with($viewData);
    }
}
