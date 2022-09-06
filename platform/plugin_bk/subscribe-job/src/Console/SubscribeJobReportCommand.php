<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/15 - 15:40
 */
namespace Workable\SubscribeJob\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Workable\SubscribeJob\Core\SubscribeJobDataBuilder;

class SubscribeJobReportCommand extends Command
{
    protected $signature = 'subscribe-job:report-run 
                            {--ids= : Report by list id}';

    protected $description = "Report subscribe job";


    protected $subscribeJobDataBuilder;

    public function __construct()
    {
        parent::__construct();

        $this->subscribeJobDataBuilder = new SubscribeJobDataBuilder();
    }

    public function handle()
    {
        $ids= $this->option("ids");
        if ($ids)
        {
            $this->reportListIds($ids);
        }
        else
        {
            $this->reportMulti();
        }
    }

    protected function reportListIds($ids)
    {
        $ids = explode(",", $ids);
        $items = DB::table("subscribe_job_sources")
                    ->whereIn("id", $ids)
                    ->get();


        $idReport = $this->reportListItem($items);
        $this->updateIdReport($idReport);
    }

    protected function reportMulti()
    {
        DB::table("subscribe_job_sources")
            ->orderBy("id")
            ->where("report_status", 0)
            ->chunkById(100, function ($items) {

                $idReport = $this->reportListItem($items);
                $this->updateIdReport($idReport);
            });
    }

    protected function reportListItem($listItem)
    {
        $idReportArr   = [];
        foreach ($listItem as $item)
        {
            $this->info("-- Report item:". $item->id);

            list($idReport, $dataReport) = $this->subscribeJobDataBuilder->setItem($item)->build();
            $this->updateDataReport($dataReport);

            $idReportArr[$item->id] = $idReport;
        }

        return $idReportArr;
    }

    /**
     * updateIdReport
     * User: Hungokata
     * Date: 2021/06/15 - 15:49
     */
    protected function updateIdReport($idReportArr)
    {
        if (!$idReportArr) return false;

        foreach ($idReportArr as $dataId => $reportItem)
        {
            DB::table("subscribe_job_sources")
                ->where("id", $dataId)
                ->update([
                    "report_status" => 1,
                    "report_meta" => json_encode($reportItem)
                ]);
        }
    }

    /**
     * updateDataReport
     * User: Hungokata
     * Date: 2021/06/15 - 15:49
     */
    protected function updateDataReport($dataReportMulti)
    {
        foreach ($dataReportMulti as $dataReportItem)
        {
            if (!$dataReportItem['attr_text']) continue;


            DB::table("subscribe_jobs")->updateOrInsert(
                [
                    'attr_text_slug' => $dataReportItem['attr_text_slug']
                ],
                [
                    'source_id' => $dataReportItem['source_id'],
                    'app_int' => $dataReportItem['app_int'],
                    'attr_int' => $dataReportItem['attr_int'],
                    'attr_text' => $dataReportItem['attr_text'],
                    'attr_text_slug' => $dataReportItem['attr_text_slug'],
                    'hint' => DB::raw('hint +1'),
                    'source_created_at' => $dataReportItem['source_created_at'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

        }
    }
}