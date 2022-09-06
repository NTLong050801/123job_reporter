<?php
namespace Workable\RobotLog\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Workable\RobotLog\Services\RobotVisitService;

class RobotVisitApiController extends Controller
{
    private $robotVisitService;

    public function __construct(RobotVisitService $robotVisitService)
    {
        $this->robotVisitService = $robotVisitService;
    }

    public function storeMulti(Request $request)
    {
        $datas = $request->all();

        $dataStore = [];

        foreach ($datas as $data)
        {
            $bot  = strtolower($data['bot'] ?? '');

            if(!in_array($bot, config('plugins.robot-log.robot_counter.list_bot'))) continue;

            try {
                $dataStore[] = $this->robotVisitService->createDataStore($data);
            }
            catch (\Exception $e)
            {
                \Log::error($e->getMessage());
            }
        }

        if($dataStore) $this->robotVisitService->store($dataStore);

        return response()->json(['error' => 0, 'message' => 'Success']);
    }
}
