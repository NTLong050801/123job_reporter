<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/12 - 16:26
 */
namespace Workable\ApplyJob\Core;


use Illuminate\Support\Str;
use Workable\ApplyJob\Enum\ApplyJobEnum;

class ApplyJobDataBuilder
{
    protected $item = null;

    private function __reset()
    {
        $this->item = null;
    }

    private function buildSlug($dataOne)
    {
        $slug = $dataOne['app_int'] .'-'. $dataOne['attr_int'].'-'.$dataOne['source_created_at'].'-'.$dataOne['attr_text'];
        $textSlug  = Str::slug($slug);
        return $textSlug;
    }

    private function buildData()
    {
        $metaTransform  = json_decode($this->item->meta_data_transform, true);
        $reportMeta     = json_decode($this->item->report_meta, true);

        $reportAttributeConfig = [
            "city" => [
                "multi" => true,
                "enum" => ApplyJobEnum::ATTRIBUTE_CITY,
                "key" => "city"
            ],
            "category" => [
                "multi" => true,
                "enum" => ApplyJobEnum::ATTRIBUTE_CATEGORY,
                "key" => "category"
            ],
            "salary" => [
                "multi" => true,
                "enum" => ApplyJobEnum::ATTRIBUTE_SALARY,
                "key" => "salary"
            ],
        ];

        $dataUpdate     = [];
        $dataSet = [
            "job_source_id" => $this->item->source_id,
            "app_int" => $this->item->app_int,
            "source_created_at" => date("Y-m-d", strtotime($this->item->source_created_at)),
            'created_at' => now(),
            "updated_at" => now()
        ];

        foreach ($reportAttributeConfig as $key => $reportItem)
        {
            $reported = $reportMeta[$key] ?? 0;
            if (!$reported)
            {
                $reportMeta[$reportItem['key']] = 1;
                $metaTransformAttr = $metaTransform[$key] ?? [];

                // Có dữ liệu thì tạo
                if ($metaTransformAttr)
                {
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
        }


        $arrRtn = [
            $reportMeta,
            $dataUpdate
        ];
        return $arrRtn;
    }

    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }

    public function build()
    {
        $data = $this->buildData();
        $this->__reset();

        return $data;
    }
}