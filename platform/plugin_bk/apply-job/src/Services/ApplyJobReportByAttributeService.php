<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/12 - 16:51
 */

namespace Workable\ApplyJob\Services;

use Workable\ApplyJob\Repository\ApplyJobRepository;


class ApplyJobReportByAttributeService extends ApplyJobReportBase
{
    /**
     * @var ApplyJobRepository
     */
    protected $applyJobRepository;

    public function __construct(ApplyJobRepository $applyJobRepository)
    {
        parent::__construct();
        $this->applyJobRepository = $applyJobRepository;

    }

    public function reportByAttribute($filterQuery = [])
    {
        $filter  = [];
        $results = $this->applyJobRepository->getListForDay($filter);

        return $results;
    }
}