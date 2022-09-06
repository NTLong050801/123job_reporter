<?php

namespace Workable\Candidate\Http\Controllers;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use Workable\Candidate\Services\Statistic\PushCandidateService;


class PushCandidateController extends AdminBaseController
{
    private $pushCandidateService;

    public function __construct(PushCandidateService $pushCandidateService)
    {
        parent::__construct();
        $this->pushCandidateService = $pushCandidateService;
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $this->pushCandidateService->setParam($params)->store();

        return response()->json([
            'status'  => 1,
            'message' => 'Push data success',
        ]);
    }
}
