<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 05/07/2022
 * Time: 11:24
 */

namespace Modules\Collect\Core\Contracts;

abstract class ProcessDataAbstract
{
    protected $country = '';

    public function setCountry($country): ProcessDataAbstract
    {
        $this->country = $country;
        return $this;
    }

    public abstract function process($items = []);
}
