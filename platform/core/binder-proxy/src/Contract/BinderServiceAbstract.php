<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/01/18 - 15:27
 */

namespace Workable\BinderProxy\Contract;

abstract class BinderServiceAbstract
{
    private function getInstanceService()
    {
        $instance = app(static::$serviceAttach);
        return $instance;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->getInstanceService(), $name], $arguments);
    }
}
