<?php

namespace Workable\AuditLog\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Workable\AuditLog\Services\HistoryLoginService;

class HistoryLoginController extends AdminBaseController
{
    protected $historyService;
    protected $viewPath = 'plugins.audit-log::history_login';

    public function __construct(HistoryLoginService $historyService)
    {
        $this->historyService = $historyService;
    }

    public function index()
    {
        $filter   = $this->getFilter();
        $sort     = [['id', 'desc']];
        $viewData = [
            'users' => $this->historyService->list($filter, $sort),
        ];
        return $this->renderView('history')->with($viewData);
    }
}
