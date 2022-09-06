<?php

namespace Workable\ManagerSite\Services;

use Workable\ManagerSite\Repository\ManagerSiteRepository;

class ManagerSiteService
{
    protected $managerSiteRepository;

    public function __construct(ManagerSiteRepository $managerSiteRepository)
    {
        $this->managerSiteRepository = $managerSiteRepository;
    }

    public function list($filter = [], $options = [])
    {
        $items = $this->managerSiteRepository->list($filter);

        return $items;
    }

    public function store($data = [])
    {
        $data['created_at'] = now();
       // $data['updated_at'] = now();
        //update time now
        return $this->managerSiteRepository->insert($data); // send data managerSiteRepository update database

    }

    public function findById($id)
    {
        $item = $this->managerSiteRepository->findById($id);
        return $item;
    }

    public function update($id, $data)
    {
        $data['updated_at'] = now();
        $this->managerSiteRepository->update($id, $data);
        return 1;
    }

    public function getSiteActive($filter)
    {
        $items = $this->managerSiteRepository->getSiteActive($filter);

        return $items;
    }


    public function delete($id)
    {
        $this->managerSiteRepository->delete($id);
        return 1;
    }
}
