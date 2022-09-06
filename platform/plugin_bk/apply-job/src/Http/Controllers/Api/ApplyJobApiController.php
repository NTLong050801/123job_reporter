<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/07/29 - 15:48
 */

namespace Workable\ApplyJob\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Workable\ApplyJob\ServiceApi\ApplyJobSourceServiceApi;
use Workable\Support\Traits\ResponseHelperTrait;

class ApplyJobApiController extends Controller
{
    use ResponseHelperTrait;

    protected $applyJobSourceServiceApi;

    public function __construct(ApplyJobSourceServiceApi $applyJobSourceServiceApi)
    {
        $this->applyJobSourceServiceApi = $applyJobSourceServiceApi;
    }

    public function report(Request $request)
    {
        $dateRange = $request->get('date_range');
        $filterQuery = [
            'date_range' => $dateRange
        ];
        $result = $this->applyJobSourceServiceApi->report($filterQuery);

        return $this->setMeta(array_except($result, ['result']))
                    ->respondSuccess("Số Apply thành công", $result['result']);
    }
}