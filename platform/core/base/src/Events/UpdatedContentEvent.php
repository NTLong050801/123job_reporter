<?php
namespace Workable\Base\Events;

use Illuminate\Queue\SerializesModels;

class UpdatedContentEvent extends Event
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

    /**
     * UpdatedContentEvent constructor.
     * @param $screen
     * @param $request
     * @param $data
     */
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
