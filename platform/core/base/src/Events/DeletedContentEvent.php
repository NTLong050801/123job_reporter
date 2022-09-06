<?php
namespace Workable\Base\Events;

use Illuminate\Queue\SerializesModels;

class DeletedContentEvent extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $screen;

    /**
     * @var
     */
    public $request;

    /**
     * @var
     */
    public $data;

    public function __construct($screen, $request, $data)
    {
        $this->screen   = $screen;
        $this->request  = $request;
        $this->data     = $data;
    }

    public function broadcastOn()
    {
        return [];
    }
}
