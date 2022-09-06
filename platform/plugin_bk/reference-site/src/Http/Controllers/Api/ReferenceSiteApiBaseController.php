<?php
namespace Workable\ReferenceSite\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Workable\ReferenceSite\Services\JobReferSourceService;
use Workable\Support\Traits\ResponseHelperTrait;

class ReferenceSiteApiBaseController extends Controller
{
    use ResponseHelperTrait;

    protected $jobReferSourceService;

    /**
     * ReferenceSiteApiBaseController constructor.
     * @param JobReferSourceService $jobReferSourceService
     */
    public function __construct(JobReferSourceService $jobReferSourceService)
    {
        $this->jobReferSourceService = $jobReferSourceService;
    }

    public function index()
    {
        return 'Hello world';
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        if ($request->get('_debug'))
        {
            return $this->respondSuccess('success', $payload);
        }

        $dataRtn =  $this->jobReferSourceService->store($payload);


        return $this->respondCreateSuccess("Create successfully", $dataRtn);

    }

}
