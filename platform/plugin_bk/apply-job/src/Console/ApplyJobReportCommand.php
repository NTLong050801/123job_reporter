<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/12 - 16:17
 */
namespace Workable\ApplyJob\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Workable\ApplyJob\Core\ApplyJobDataBuilder;
use Workable\ApplyJob\Enum\ApplyJobEnum;

class ApplyJobReportCommand extends Command
{
    protected $signature = 'apply-job:run
                    {--ids= : Report cho các job }
                    {--time_range= : Khoảng time cần chạy ... }
                ';

    protected $description = 'Report apply job command';

    protected $applyJobDataBuilder;

    public function __construct()
    {
        parent::__construct();
        $this->applyJobDataBuilder = new ApplyJobDataBuilder;
    }

    public function handle()
    {
        $timeRange = $this->option("time_range");
        $ids = $this->option("ids");

        if ($ids)
        {
            $this->reportIds($ids);
        }else
        {
            $this->reportMulti($timeRange);
        }
    }

    protected function reportIds($ids)
    {
        $ids = explode(",", $ids);
        $items = DB::table("apply_job_sources")
            ->whereIn("id", $ids)
            ->where("report_status", ApplyJobEnum::STATUS_REPORT_INIT)
            ->get();

        $this->__reportListItem($items);
    }

    protected function reportMulti($timeRange)
    {
        $queryBuilder = DB::table("apply_job_sources")
            ->orderBy("id", "desc");

        if ($timeRange)
        {
            $times = \FilterHelper::getStartEndTime($timeRange);
            $queryBuilder->where("created_at", ">=", $times['start'])
                ->where("created_at", "<=", $times['end']);
        }

        $queryBuilder->where("report_status",ApplyJobEnum::STATUS_REPORT_INIT)
            ->chunkById(500, function ($items) {
                $this->__reportListItem($items);
            });
    }

    /**
     * __reportListItem
     * @param $items
     * User: Hungokata
     * Date: 2021/06/08 - 22:18
     */
    protected function __reportListItem($items)
    {
        $dataIds = [];
        foreach ($items as $item)
        {
            $this->info("-- Run report:". $item->id);

            list($reportMetaField, $dataReportMulti) = $this->applyJobDataBuilder->setItem($item)->build();

            $this->__storeReportPre($dataReportMulti);

            $dataIds[$item->id] = $reportMetaField;
        }
        $this->__updateAnalyst($dataIds);
    }

    // https://tableplus.com/blog/2018/11/how-to-update-multiple-rows-at-once-in-mysql.html
    private function __updateAnalyst($dataIds)
    {
        if (!$dataIds) return false;

        foreach ($dataIds as $dataId => $analystaMeta)
        {
            DB::table("apply_job_sources")
                ->where("id", $dataId)
                ->update([
                    "report_status" => ApplyJobEnum::STATUS_REPORT_DONE,
                    "report_meta" => $analystaMeta
                ]);
        }

    }

    /**
     * __storeReportPre
     * @param $dataReportMulti
     * User: Hungokata
     * Date: 2021/06/10 - 18:13
     */
    private function __storeReportPre($dataReportMulti)
    {
        foreach ($dataReportMulti as $dataReportItem)
        {
            DB::table("apply_jobs")->updateOrInsert(
                [
                    'attr_text_slug' => $dataReportItem['attr_text_slug']
                ],
                [
                    'job_source_id' => $dataReportItem['job_source_id'],
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