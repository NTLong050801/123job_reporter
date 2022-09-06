<?php
/**
 * Created by PhpStorm.
 * User: ThaiLe
 * Date: 17/06/2021
 * Time: 4:19 PM
 */
namespace Workable\RobotLog\Services;

use Illuminate\Support\Facades\DB;
use Workable\RobotLog\Repository\RobotVisitRepository;

class RobotVisitService
{
    protected $robotCounterRepository;

    public function __construct(RobotVisitRepository $robotCounterRepository)
    {
        $this->robotCounterRepository = $robotCounterRepository;
    }

    public function getList($filterQuery = [], $paginate = 0)
    {
        $filter = $this->__buildFilter($filterQuery);
        $results = $this->robotCounterRepository->getList($filter, $paginate);

        return $results;
    }

    public function store($data)
    {
        return DB::table('robot_visits')->insert($data);
    }

    private function __buildFilter($filterQuery = [])
    {
        $date       = $filterQuery['date_range'] ?? null;
        $times      = $date ? \FilterHelper::getStartEndTimeVn($date) : null;
        $label_page = $filterQuery['label_page'] ?? null;
        $path       = $filterQuery['path'] ?? null;
        $app_int    = $filterQuery['app_int'] ?? null;
        $bot        = $filterQuery['bot'] ?? null;
        $order      = $filterQuery['order'] ?? null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = $times['start'];
            $filter['end_time'] = $times['end'];
        }
        if($label_page) $filter['label_page'] = $label_page;
        if($path) $filter['path'] = $path;
        if($app_int) $filter['app_int'] = $app_int;
        if($order) $filter['order'] = $order;
        if($bot) $filter['bot'] = $bot;

        return $filter;
    }

    public function createDataStore($input)
    {
        $config = config('plugins.google-log.config');

        $urlVisit = $input['url_visit'];

        list($path, $labelPage) = $this->__detectPath($urlVisit);

        return  [
            'app_int'      => $input['app_int'],
            'app_text'     => $config['app'][$input['app_int']],
            'bot'          => strtolower($input['bot']),
            'visited_at'   => $input['visited_at'],
            'execute_time' => $input['execute_time'],
            'url_visit'    => $urlVisit,
            'path'         => $path,
            'label_page'   => $labelPage,
            'ip_address'   => $input['ip_address'],
            'created_at'   => $input['created_at'] ?? now(),
            'updated_at'   => $input['updated_at'] ?? now(),
        ];
    }

    private function __detectPath($urlVisit)
    {
        $config = config('plugins.google-log.config');
        foreach ($config['page'] as $labelPage => $paths)
        {
            foreach ($paths as $path)
            {
                if(mb_strpos($urlVisit, $path) === 0)
                {
                    return [$path, $labelPage];
                }
            }
        }
        return [null, null];
    }
}