<?php
namespace Workable\Candidate\Services;
use Illuminate\Http\Request;
use Workable\Candidate\Repository\Career\CareerRepositoryInterface;

class CareerService
{
    protected $careerRepository;

    public function __construct(CareerRepositoryInterface $careerRepository)
    {
        $this->careerRepository = $careerRepository;
    }


    public function list(Request $request)
    {
        $param  = [];
        $filter = [];
        $this->careerRepository->setParam($param);
        return $this->careerRepository->list($filter);
    }
}
