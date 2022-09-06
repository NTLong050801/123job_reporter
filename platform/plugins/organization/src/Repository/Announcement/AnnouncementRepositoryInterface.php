<?php


namespace Workable\Organization\Repository\Announcement;


interface AnnouncementRepositoryInterface
{
    public function list($filter=[], $field=['*'], $paginate= 20);

    public function newList();
}
