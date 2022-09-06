<?php
namespace Workable\ApplyJob\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Workable\ApplyJob\Services\ApplyJobSourceService;
use Workable\Support\Traits\ResponseHelperTrait;

class ApplyJobApiBaseController extends Controller
{
    use ResponseHelperTrait;

    protected $applyJobSourceService;

    public function __construct(ApplyJobSourceService $applyJobSourceService)
    {
        $this->applyJobSourceService = $applyJobSourceService;
    }

    public function store(Request $request)
    {
        $payLoad = $request->all();
        if ($request->get('_debug'))
        {
            return $this->respondSuccess('Success', $payLoad);
        }
        try
        {
            $dataRtn = $this->applyJobSourceService->store($payLoad);
            return $this->respondCreateSuccess('Create successfully', $dataRtn);
        }
        catch (\Exception $e)
        {
            return $this->respondCreateFail('Create fail', 'error', $e->getMessage());
        }
    }
}
