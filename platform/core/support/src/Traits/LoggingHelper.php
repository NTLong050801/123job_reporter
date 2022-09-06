<?php


namespace Workable\Support\Traits;


use Workable\Base\Supports\CliEcho;

trait LoggingHelper
{
    protected $log = true;

    protected function cal($start, $end, $name)
    {
        $execute = ($end - $start) * 1000 . ' ms';
        $this->execute = $execute;

        $this->logTime($name, $execute);
    }

    protected function logTime($name, $time)
    {
        if (!$this->log) return false;
        CliEcho::infonl("-- ". $name . ': '. $time);
    }
}
