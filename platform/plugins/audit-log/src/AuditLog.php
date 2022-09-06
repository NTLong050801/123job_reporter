<?php

namespace Workable\AuditLog;

use Eloquent;
use Illuminate\Http\Request;
use Workable\AuditLog\Events\AuditHandlerEvent;
use Workable\Base\Events\CreatedContentEvent;
use Workable\Base\Events\DeletedContentEvent;
use Workable\Base\Events\UpdatedContentEvent;

class AuditLog
{
    protected $screen;

    protected $request;

    protected $dataSent;

    protected $type = 'info';

    /**
     * @param Request $request
     */
    public function request(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @param $data
     */
    public function data($data)
    {
        $this->dataSent = $data;
        return $this;
    }


    /**
     * @param $screen
     * @return $this
     */
    public function screen($screen)
    {
        $this->screen = $screen;
        return $this;
    }


    /**
     * @param $screen
     * @param $data
     * @param $action
     * @param string $type
     * @return bool
     */
    public function handleEvent($screen, $data, $action, $type = 'info')
    {
        if (!$data instanceof Eloquent || !$data->id) {
            return false;
        }
        event(new AuditHandlerEvent($screen, $action, $data->id, $this->getReferenceName($screen, $data), $type));
    }

    /**
     * Fire eventUpdated
     */
    public function updated()
    {
        event(new UpdatedContentEvent($this->screen, $this->request, $this->dataSent));
    }

    /**
     * Fire eventDeleted
     */
    public function deleted()
    {
        event(new DeletedContentEvent($this->screen, $this->request, $this->dataSent));
    }

    /**
     * Fire eventCreated
     */
    public function created()
    {
        event(new CreatedContentEvent($this->screen, $this->request, $this->dataSent));
    }

    /**
     * @param $screen
     * @param $data
     * @return null
     */
    public function getReferenceName($screen, $data)
    {
        $name = null;
        switch ($screen) {
            default:
                if (isset($data->name)) {
                    $name = $data->name;
                } elseif (isset($data->titlte)) {
                    $name = $data->title;
                }
                break;
        }

        return $name;
    }
}
