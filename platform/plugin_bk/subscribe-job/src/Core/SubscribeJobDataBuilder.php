<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/15 - 15:58
 */

namespace Workable\SubscribeJob\Core;

use Illuminate\Support\Str;
use Workable\SubscribeJob\Enum\SubscribeJobEnum;

class SubscribeJobDataBuilder
{
    protected $item;

    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }

    private function buildSlug($dataOne)
    {
        $slug = $dataOne['app_int'] .'-'. $dataOne['attr_int'].'-'.$dataOne['source_created_at'].'-'.$dataOne['attr_text'];
        $textSlug  = Str::slug($slug);
        return $textSlug;
    }

    protected function _makeData()
    {
        $dataReport = [];
        $reportMeta = [];


        $reportAttributeConfig = [
            "city" => [
                "multi" => true,
                "enum" => SubscribeJobEnum::ATTRIBUTE_CITY,
                "key" => "usk_city"
            ],
            "salary" => [
                "multi" => true,
                "enum" => SubscribeJobEnum::ATTRIBUTE_SALARY,
                "key" => "usk_salary"
            ],
            "source" => [
                "multi" => true,
                "enum" => SubscribeJobEnum::ATTRIBUTE_SOURCE,
                "key" => "usk_source"
            ],
        ];

        $dataSet = [
            "source_id" => $this->item->source_id,
            "app_int" => $this->item->app_int,
            "source_created_at" => $this->item->source_created_at,
            'created_at' => now(),
            "updated_at" => now()
        ];

        foreach ($reportAttributeConfig as $key => $reportItem)
        {
            if ($reportItem['key'])
            {
                $reportMeta[$key] = 1;
                $keyField = $reportItem['key'];
                $dataReportOne = [
                    "attr_int" => $reportItem['enum'],
                    "attr_text" => $this->item->$keyField
                ];

                $dataOne                    = array_merge($dataSet, $dataReportOne);
                $dataOne["attr_text_slug"]  = $this->buildSlug($dataOne);
                $dataReport[$key]           = $dataOne;
            }
        }

        return [
            $reportMeta,
            $dataReport
        ];
    }

    public function build()
    {
        $dataRtn = $this->_makeData();
        $this->item = null;
        return $dataRtn;
    }
}