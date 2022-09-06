<?php


namespace Workable\AuditLog\Listeners;

use Workable\AuditLog\Events\AuditHandlerEvent;
use Workable\Base\Events\DeletedContentEvent;

use AuditLog;

class DeletedContentListener
{
    public function handle(DeletedContentEvent $event)
    {
        try {
            event(new AuditHandlerEvent(
                $event->screen,
                'deleted',
                $event->data->id,
                AuditLog::getReferenceName($event->screen, $event->data),
                'danger'
            ));
        }catch (\Exception $e)
        {
            info($e->getMessage());
        }
    }
}
