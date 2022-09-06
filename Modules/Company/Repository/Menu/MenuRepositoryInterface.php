<?php


namespace Modules\Company\Repository\Menu;


interface MenuRepositoryInterface
{

    public function list($filter, $fields=['*'], $paginate=[]);

    public function listMenuByPermission($filter);

    public function findOneBySlug($slug);

    public function firstById($id);

    public function delete($id);

    public function insertData($data);

    public function incrementHit($menuId, $column);
}
