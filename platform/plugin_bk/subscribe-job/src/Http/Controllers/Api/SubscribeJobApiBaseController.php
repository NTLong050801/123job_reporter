<?php
namespace Workable\SubscribeJob\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Workable\SubscribeJob\Services\SubscribeJobSourceService;
use Workable\Support\Traits\ResponseHelperTrait;


class SubscribeJobApiBaseController extends Controller
{
    use ResponseHelperTrait;

    protected $subscribeJobSourceService;

    public function __construct(SubscribeJobSourceService $subscribeJobSourceService)
    {
        $this->subscribeJobSourceService = $subscribeJobSourceService;
    }

    /**
     * store
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * User: Hungokata
     * Date: 2021/06/17 - 17:06
     */
    public function store(Request $request)
    {
        $payload = $request->all();
        $debug = $request->get('_debug');
        if ($debug)
        {
            return $this->respondSuccess('Success sent', $payload);
        }

        try
        {
            $dataRtn = $this->subscribeJobSourceService->store($payload);
            return $this->respondCreateSuccess('Create successfully', $dataRtn);
        }
        catch (\Exception $e)
        {
            return $this->respondCreateFail('Create fail', 'error', $e->getMessage());
        }
    }
}
