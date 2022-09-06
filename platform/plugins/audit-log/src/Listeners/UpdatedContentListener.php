<?php
namespace Workable\AuditLog\Listeners;

use AuditLog;
use Workable\AuditLog\Events\AuditHandlerEvent;
use Workable\Base\Events\UpdatedContentEvent;

class UpdatedContentListener
{
    public function handle(UpdatedContentEvent $event)
    {
        try {
            event(new AuditHandlerEvent(
                $event->screen,
                'updated',
                $event->data->id,
                AuditLog::getReferenceName($event->screen, $event->data),
                'primary'
            ));
        }catch (\Exception $e)
        {
            info($e->getMessage());
        }
    }
}
