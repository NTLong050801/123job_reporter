<?php


namespace Workable\Organization\Repository\Product;


interface ProductRepositoryInterface
{
    public function list($filter = [], $field = ['*'], $paginate = 20);

    public function listChildLevel($filter = [], $field = ['*']);
}
