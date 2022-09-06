<?php
/**
 * Created by PhpStorm.
 * User: ThaiLe
 * Date: 17/06/2021
 * Time: 4:19 PM
 */
namespace Workable\RobotLog\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Workable\RobotLog\Models\RobotCounter;
use Workable\RobotLog\Repository\RobotCounterRepository;
use Workable\RobotLog\Utils\RobotCounterReportUtil;

class RobotCounterService
{
    protected $robotCounterRepository;
    protected $robotCounterReportUtil;

    public function __construct(RobotCounterRepository $robotCounterRepository,
                                RobotCounterReportUtil $robotCounterReportUtil)
    {
        $this->robotCounterRepository = $robotCounterRepository;
        $this->robotCounterReportUtil = $robotCounterReportUtil;
    }

    public function getList($filterQuery = [], $paginate = 0)
    {
        $filter = $this->__buildFilter($filterQuery);
        $results = $this->robotCounterRepository->getList($filter, $paginate);

        return $results;
    }

    public function getDataForChart($filterQuery = [])
    {
        $filter = $this->__buildFilter($filterQuery);
        $results = $this->robotCounterRepository->getList($filter);

        $dates = [];
        $startDate = Carbon::createFromFormat('Y-m-d', $filter['start_time']);
        $endDate = Carbon::createFromFormat('Y-m-d', $filter['end_time']);
        $diffDay = $startDate->diffInDays($endDate);
        $dates[] = $startDate->format('Y-m-d');
        for($i = 1; $i<= $diffDay; $i ++)
        {
            $dates[] = $startDate->addDay()->format('Y-m-d');
        }

        $results = $this->robotCounterReportUtil->transformForChart($results, $dates);

        return $results;
    }

    public function updateOrCreate($dataPath)
    {
        $dateRobot = $this->createDataStore($dataPath);
        $dateRobot['updated_at'] = now();


        $robotItem= DB::table("robot_counters")
                    ->where("app_int", $dateRobot['app_int'])
                    ->where("bot", $dateRobot['bot'])
                    ->where("date", $dateRobot['date'])
                    ->where("path", $dateRobot['path'])
                    ->first();

        if ($robotItem)
        {
            $robotItem = (array)$robotItem;
            $dateRobot['min_execute_time'] = $robotItem['min_execute_time'] < $dateRobot['min_execute_time']
                                            ? $dateRobot['min_execute_time']
                                            : $robotItem['min_execute_time'];

            $dateRobot['max_execute_time'] = $robotItem['max_execute_time'] > $dateRobot['max_execute_time']
                                                ? $robotItem['max_execute_time']
                                                : $dateRobot['max_execute_time'];

            $dateRobot['total_visit'] += $robotItem['total_visit'];
            $dateRobot['total_time']  += $robotItem['total_time'];

            $dateRobot['avg_execute_time'] = (int)($dateRobot['total_time']/$dateRobot['total_visit']);

            DB::table("robot_counters")->where("id", $robotItem['id'])->update($dateRobot);
        }
        else
        {
            $dateRobot['created_at'] = now();
            DB::table("robot_counters")->insertOrIgnore($dateRobot);
        }
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

        return  [
            'app_int'          => $input['app_int'],
            'app_text'         => $config['app'][$input['app_int']],
            'bot'              => strtolower($input['bot']),
            'total_visit'      => $input['total_visit'],
            'total_time'       => $input['total_time'],
            'date'             => $input['date'],
            'path'             => $input['path'],
            'label_page'       => $input['label_page'],
            'min_execute_time' => $input['min_execute_time'],
            'max_execute_time' => $input['max_execute_time'],
            'avg_execute_time' => $input['avg_execute_time'],
        ];
    }
}