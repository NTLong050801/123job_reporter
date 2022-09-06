<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/07/15 - 13:48
 */

namespace Workable\Support\Event;

trait PipeEvent
{
    protected $callBacks = [];

    public function assignCallback($event, ...$params)
    {
        $cb = $this->getCallback($event);
        if (empty($cb)) {
            return null;
        }

        if (!is_callable($cb)) {
            throw new \Exception("-- Callback function must be callable");
        }

        return call_user_func_array($cb, $params);
    }

    public function addCallback($event, $cb)
    {
        if (!is_callable($cb)) {
            throw new \Exception("-- Callback function must be callable");
        }

        $this->callBacks[$event] = $cb;
    }


    public function getCallback($event)
    {
        return array_get($this->callBacks, $event, null);
    }
}