<?php

namespace Workable\Candidate\Services;

use Illuminate\Http\Request;
use Workable\Candidate\Repository\Candidate\CandidateRepositoryInterface;

class CandidateService
{
    protected $candidateRepository;

    public function __construct(CandidateRepositoryInterface $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    /**
     * Note:
     * @param Request $request
     * @return mixed
     * User: TranLuong
     * Date: 09/04/2021
     */
    public function list(Request $request)
    {
        $param = [
            'month_range' => $request->get('month_range'),
            'order'       => [['id', 'desc']],
        ];

        $filter = [
            ['career_int', '=', $request->get('career')],
            ['rank_int', '=', $request->get('rank')],
            ['degree_int', '=', $request->get('degree')],
            ['source_int', "=", $request->get('source')],
        ];

        $this->candidateRepository->setParam($param);

        return $this->candidateRepository->list($filter);
    }
}
