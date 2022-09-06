<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/17 - 14:29
 */

namespace Workable\ReferenceSite\Services;


use Illuminate\Support\Facades\Log;
use Workable\ReferenceSite\Enum\JobReferEnum;
use Workable\ReferenceSite\Repository\JobReferSourceRepository;

class JobReferSourceService
{
    protected $jobReferSourceRepository;

    public function __construct(JobReferSourceRepository $jobReferSourceRepository)
    {
        $this->jobReferSourceRepository = $jobReferSourceRepository;
    }


    public function store($dataInput = [])
    {
        try
        {
            $dataStore = [
                "source_id"            => $dataInput['source_id'],
                'app_int'              => $dataInput['app_int'] ?? 1,
                'app_text'             => $dataInput['app_text'] ?? '123job',
                'site_name'            => $dataInput['site_name'],
                'provider_id'          => $dataInput['provider_id'],
                'meta_data'            => $dataInput['meta_data'] ?? null,
                'meta_data_transform'  => $dataInput['meta_data_transform'] ?? null,
                'meta_agent'           => $dataInput['meta_agent'] ?? null,
                'meta_agent_transform' => $dataInput['meta_agent_transform'] ?? null,
                'analyst_status'       => JobReferEnum::STATUS_ANALYST_INIT,
                'report_status'        => JobReferEnum::STATUS_REPORT_INIT,
                'report_meta'          => null,
                'source_created_at'    => $dataInput['source_created_at'],
                "created_at"           => now(),
                "updated_at"           => now()
            ];

            return $this->jobReferSourceRepository->store($dataStore);
        }
        catch (\Exception $e)
        {
            Log::warning(get_data_exception($e));

            return get_data_exception($e);
        }
    }


}