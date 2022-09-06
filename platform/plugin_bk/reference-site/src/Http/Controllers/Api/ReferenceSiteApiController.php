<?php
namespace Workable\ReferenceSite\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Workable\ReferenceSite\ServicesApi\JobReferServiceApi;
use Workable\Support\Traits\ResponseHelperTrait;

class ReferenceSiteApiController extends Controller
{
    use ResponseHelperTrait;

    protected $jobReferServiceApi;

    public function __construct(JobReferServiceApi $jobReferServiceApi)
    {
        $this->jobReferServiceApi = $jobReferServiceApi;
    }

    public function report(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];
        $result = $this->jobReferServiceApi->list($filterQuery);

        return $this->setMeta(array_except($result, ['result']))
                    ->respondSuccess("Success", $result['result']);
    }
}
