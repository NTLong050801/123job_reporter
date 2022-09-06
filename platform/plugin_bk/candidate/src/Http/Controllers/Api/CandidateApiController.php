<?php


namespace Workable\Candidate\Http\Controllers\Api;


use Illuminate\Http\Request;
use Workable\Candidate\Repository\Candidate\CandidateRepository;

class CandidateApiController extends CandidateApiBaseController
{
    protected $candidateRepository;

    public function __construct(CandidateRepository  $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $store = $this->candidateRepository->store($data);
        if ($store){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }

    }
}
