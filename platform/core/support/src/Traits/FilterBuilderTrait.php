<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 5/19/19
 * Time: 16:57
 */

namespace Workable\Support\Traits;


trait FilterBuilderTrait
{
    protected $filter = [];
    protected $order = [];


    public function setFilter($param, $field, $ope, $defValue = null)
    {
        $value = $param[$field] ?? $defValue;

        if ($value != '' || $value !== null)
        {
            if (strtoupper($ope) == 'LIKE')
            {
                $value = '%' . trim($value) . '%';
            }
            $this->filter[] = [$field, $ope, trim($value)];

        }
    }

    public function setOrder($param, $field, $direction = 'desc')
    {
        $direction = $param[$field] == 'asc' ? 'asc' : $direction;
        $this->order[] = [$field, $direction];
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getFilter()
    {

        return $this->filter;
    }
}
