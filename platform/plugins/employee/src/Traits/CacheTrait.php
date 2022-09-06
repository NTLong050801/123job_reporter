<?php

namespace Workable\Employee\Traits;

trait CacheTrait
{
    public function makeKeyCache($prefix, $id, $order = 50)
    {
        $cache_key    = $prefix;
        $order_number = 1 + (int)($id / $order);
        return $cache_key . ':' . $order_number . ':' . $id;
    }
}
