<?php
namespace Workable\AuditLog\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AuditLogApiBaseController extends Controller
{
    public function index()
    {
        return 'Welcome to controller api: '. __("plugins.audit-log::app.name");
    }
}
