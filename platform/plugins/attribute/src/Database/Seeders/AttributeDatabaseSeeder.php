<?php

namespace Workable\Attribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Workable\Attribute\Enum\AttributeTypeEnum;
use Workable\Attribute\Repository\AttributeRepositoryInterface;
use Workable\Attribute\Services\AttributeService;

class AttributeDatabaseSeeder extends Seeder
{
    protected $attributeService;
    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = require(platform_path('plugins/attribute/src/Database/Files/attribute.php'));
        foreach ($items as $type => $item)
        {
            foreach ($item as $itemSub)
            {
                $slug = Str::slug($itemSub);
                $data = [
                    'name' => $itemSub,
                    'slug' => $slug,
                    'type' => $type,
                    'type_text' => AttributeTypeEnum::$statusText[$type]['name']
                ];
                $itemOne = $this->findBySlug($slug, $type);
                if (!$itemOne)
                {
                    $this->attributeService->insert($data);
                }
            }
        }
    }

    public function findBySlug($slug, $type)
    {
        $filter = [
            [
                'slug', '=', $slug
            ],
            [
                'slug', '=', $type
            ]
        ];
        $this->attributeService->findBy($filter);
    }
}
