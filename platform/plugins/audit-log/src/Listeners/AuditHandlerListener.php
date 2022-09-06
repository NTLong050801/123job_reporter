<?php

namespace Workable\AuditLog\Listeners;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Workable\AuditLog\Events\AuditHandlerEvent;
use Workable\AuditLog\Models\Activity;

class AuditHandlerListener
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(AuditHandlerEvent $event)
    {
        $agent = new Agent();
        $data['admin_id'] = $event->referenceUser;
        $data['platform'] = $agent->platform();
        $data['browser'] = $agent->browser();
        $data['ip_address'] = $this->request->ip();
        $data['action'] = $event->action;
        $data['route'] = $this->request->path();
        $data['created_at'] = now();
        $data['description'] = $event->action . ' ' .  $event->module;
        $data['reference_id'] = $event->referenceId;
        $data['type'] = $event->type ?? null;
        // dd($data);
        // Activity::insert($data);
        // $data = [
        //     'user_agent' => $this->request->userAgent(),
        //     'ip_address' => $this->request->ip(),
        //     'module' => $event->module,
        //     'action' => $event->action,
        //     'user_id' => $this->request->user() ? $this->request->user()->getKey() : 0,
        //     'reference_user' => $event->referenceUser,
        //     'reference_id' => $event->referenceId,
        //     'reference_name' => $event->referenceName,
        //     'type' => $event->type
        // ];

        if (!in_array($event->action, ['loggedin', 'password'])) {
            $data['request'] = json_encode($this->request->except(['_token']));
        }

        $this->createAuditLog($data);
    }

    /**
     * Ghi dữ liệu tại đây
     * @param $data
     * Model/Eloquent
     */
    private function createAuditLog($data)
    {
        Activity::create($data);
    }
}
