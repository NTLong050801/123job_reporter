<?php

namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogQueryExecuted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QueryExecuted  $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        $log = new Logger(getenv('APP_ENV'));
        $file = storage_path(). '/sqls/sql-' . date('Y-m-d') . '.log';
        $log->pushHandler(new StreamHandler($file, Logger::DEBUG));

        $logSql = array();
        $traces = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        foreach ($traces as $trace)
        {
            // Find the first non-vendor-dir file in the backtrace
            if (isset($trace['file']) && ! str_contains($trace['file'], DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR))
            {
                $logSql['file'] = $trace['file'];
                $logSql['line'] = $trace['line'];
                break;
            }
        }
        $logSql['sql']      = $event->sql;
        $logSql['bindings'] = $event->bindings;
        $logSql['time']     = $event->time;
//        $logSql['info']   = 'Device: '. detectDevice(true) . json_encode(visit_info());

        // Insert bindings into query
        $query = str_replace(array('%', '?'), array('%%', '%s'), $event->sql);
        $logSql['builder'] = vsprintf($query, $event->bindings);

        if($event->time > 0.5)
        {
            @chmod($file, 0777);
            $log->warning(json_encode($logSql, JSON_UNESCAPED_UNICODE));
        }
    }
}
