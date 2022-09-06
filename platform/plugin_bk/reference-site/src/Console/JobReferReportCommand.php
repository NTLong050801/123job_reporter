<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/08 - 22:13
 */
namespace Workable\ReferenceSite\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Workable\ReferenceSite\Enum\JobReferEnum;

class JobReferReportCommand extends Command
{
    protected $signature = 'job-refer:report-run 
                    {--ids= : Report cho các job }
                    {--time_range= : Khoảng time cần chạy ... }
                    ';

    protected $description = 'Chạy report job refer';

    public function __construct()
    {
        parent::__construct();
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
        $items = DB::table("job_refer_sources")
                ->whereIn("id", $ids)
                ->where("report_status", 0)
                ->get();

        $this->__reportListItem($items);
    }

    protected function reportMulti($timeRange)
    {
        $queryBuilder = DB::table("job_refer_sources")
                        ->orderBy("id", "desc");

        if ($timeRange)
        {

            $times = \FilterHelper::getStartEndTime($timeRange);
            $queryBuilder->where("created_at", ">=", $times['start'])
                        ->where("created_at", "<=", $times['end']);
        }

        $queryBuilder->where("report_status",0)
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

            list($reportMetaField, $dataReportMulti) = $this->buildData($item);

            $this->__storeReportPre($dataReportMulti);

            $dataIds[$item->id] = $reportMetaField;
        }
        $this->__updateAnalyst($dataIds);
    }

    private function buildData($item)
    {
        $metaTransform = json_decode($item->meta_data_transform, true);
        $reportMeta     = json_decode($item->report_meta, true);

        $reportAttributeConfig = [
            "city" => [
                "multi" => true,
                "enum" => JobReferEnum::ATTRIBUTE_CITY,
                "key" => "city"
            ],
            "category" => [
                "multi" => true,
                "enum" => JobReferEnum::ATTRIBUTE_CATEGORY,
                "key" => "category"
            ],
            "salary" => [
                "multi" => true,
                "enum" => JobReferEnum::ATTRIBUTE_SALARY,
                "key" => "salary"
            ],
        ];

        $reportSite     = $reportMeta['site'] ?? 0;
        $dataUpdate     = [];
        $dataSet = [
            "job_source_id" => $item->source_id,
            "app_int" => $item->app_int,
            "source_created_at" => date("Y-m-d", strtotime($item->source_created_at)),
            'created_at' => now(),
            "updated_at" => now()
        ];

        if (!$reportSite)
        {
            $reportMeta['site'] = 1;
            $dataItem = [
                "attr_int" => JobReferEnum::ATTRIBUTE_PROVIDER,
                "attr_text" => $item->site_name
            ];
            $dataOne = array_merge($dataSet, $dataItem);
            $dataOne['attr_text_slug'] = $this->buildSlug($dataOne);

            $dataUpdate[] = $dataOne;
        }

        foreach ($reportAttributeConfig as $key => $reportItem)
        {
            $reported = $reportMeta[$key] ?? 0;
            if (!$reported)
            {
                $reportMeta[$reportItem['key']] = 1;
                $metaTransformAttr = $metaTransform[$key] ?? [];
                foreach ($metaTransformAttr as $metaTransformItem)
                {
                    $dataItem = [
                        "attr_int" => $reportItem['enum'],
                        "attr_text" => $metaTransformItem['name'],
                    ];

                    $dataOne = array_merge($dataSet, $dataItem);
                    $dataOne['attr_text_slug'] = $this->buildSlug($dataOne);
                    $dataUpdate[] = $dataOne;
                }
            }
        }

        $arrRtn = [
            $reportMeta,
            $dataUpdate
        ];
        return $arrRtn;
    }

    private function buildSlug($dataOne)
    {
        $slug       = $dataOne['app_int'] .'-'. $dataOne['attr_int'].'-'.$dataOne['source_created_at'].'-'.$dataOne['attr_text'];
        $textSlug  = Str::slug($slug);

        return $textSlug;
    }

    // https://tableplus.com/blog/2018/11/how-to-update-multiple-rows-at-once-in-mysql.html
    private function __updateAnalyst($dataIds)
    {
        if (!$dataIds) return false;

        foreach ($dataIds as $dataId => $analystaMeta)
        {
            DB::table("job_refer_sources")
                ->where("id", $dataId)
                ->update([
                    "report_status" => 1,
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
            if (empty($dataReportItem['attr_text'])) continue;

            DB::table("job_refers")->updateOrInsert(
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