<?php
namespace Workable\Organization\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = require_once (plugin_path('organization').'/src/Database/Files/department.php');
        foreach ($items as $item)
        {
            \CliEcho::infonl('-- Run:'. $item['company_name']);
            $companyId = $this->findCompanySlug($item['company_name']);
            try
            {
                $departmentId = $this->store($item, $companyId);
                if (isset($item['sub']))
                {
                    foreach ($item['sub'] as $itemSub)
                    {
                        $companyId = $this->findCompanySlug($itemSub['company_name']);
                        $this->store($itemSub, $companyId, $departmentId);
                    }
                }
            }catch (\Exception $e)
            {
                cli_warning_nl($e);
            }
        }
    }

    private function store($data, $companyId, $departmentId=0)
    {
        unset($data['company_name']);
        unset($data['sub']);

        $data['company_id']   = $companyId;
        $data['slug']         = Str::slug($data['name']);
        $data['parent_id']    = $departmentId;
        $data['admin_id']     = 1;
        $data['created_at']   = now();
        $data['updated_at']   = now();


        $item = DB::table('departments')
                    ->where('company_id', $companyId)
                    ->where('slug', Str::slug($data['name']))
                    ->first();

        if ($item)
        {
            return $item->id;
        }
        else
        {
            return DB::table('departments')->insertGetId($data);
        }
    }

    private function findCompanySlug($name)
    {
        $slug = Str::slug($name);
        $item = DB::table('companies')->where('slug', $slug)->first(['id','slug']);
        return $item->id ?? 1;
    }
}
