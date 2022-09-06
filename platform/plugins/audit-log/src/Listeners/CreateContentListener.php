<?php


namespace Workable\AuditLog\Listeners;


use Illuminate\Support\Collection;
use Workable\AuditLog\Events\AuditHandlerEvent;
use Workable\Base\Events\CreatedContentEvent;
use AuditLog;

class CreateContentListener
{
    public function handle(CreatedContentEvent $event)
    {
        try {
            if (isset($event->data->id))
            {
                event(new AuditHandlerEvent(
                    $event->screen,
                    'created',
                    $event->data->id,
                    AuditLog::getReferenceName($event->screen, $event->data),
                    'info'
                ));
            }
        }catch (\Exception $e)
        {
            info($e->getMessage());
        }
    }
}
