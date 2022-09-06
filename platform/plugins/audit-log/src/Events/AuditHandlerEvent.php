<?php
namespace Workable\AuditLog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Event;

class AuditHandlerEvent extends Event
{
    protected $guard = 'admins';

    use SerializesModels;

    public $module;

    public $action;

    public $referenceId;

    public $referenceUser;

    public $referenceName;

    public $type;

    public function __construct($module, $action, $referenceId, $referenceName, $type, $referenceUser = 0)
    {
        if ($referenceUser === 0 && Auth::guard($this->guard)->check())
        {
            $referenceUser = Auth::guard($this->guard)->id();
        }

        $this->module = $module;
        $this->action = $action;
        $this->referenceId = $referenceId;
        $this->referenceName = $referenceName;
        $this->referenceUser = $referenceUser;
        $this->type = $type;
    }


    /**
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

}
