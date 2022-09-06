<?php

namespace Workable\AuditLog;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

// Plugin
use Workable\AuditLog\Events\AuditHandlerEvent;
use Workable\AuditLog\Listeners\AuditHandlerListener;
use Workable\AuditLog\Listeners\CreateContentListener;
use Workable\AuditLog\Listeners\DeletedContentListener;
use Workable\AuditLog\Listeners\UpdatedContentListener;

// Core
use Workable\Base\Events\CreatedContentEvent;
use Workable\Base\Events\DeletedContentEvent;
use Workable\Base\Events\UpdatedContentEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener
     *
     * @var array
     */
    protected $listen = [
        AuditHandlerEvent::class => [
            AuditHandlerListener::class
        ],
        CreatedContentEvent::class => [
            CreateContentListener::class
        ],
        UpdatedContentEvent::class => [
            UpdatedContentListener::class
        ],
        DeletedContentEvent::class => [
            DeletedContentListener::class
        ]
    ];

    public function boot()
    {
        parent::boot();
    }
}
