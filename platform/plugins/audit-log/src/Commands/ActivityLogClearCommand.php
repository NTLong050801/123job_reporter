<?php
namespace Workable\AuditLog\Commands;

use Illuminate\Console\Command;

class ActivityLogClearCommand extends Command
{
    protected $name = 'audit-log:clear';
    protected $description = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

    }
}
