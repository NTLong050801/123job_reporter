<?php
/**
 * Created by PhpStorm.
 * User: HUNG
 * Date: 2/11/2017
 * Time: 1:58 AM
 */
namespace Workable\Support\Traits;

trait RecursiveClassTrait
{

    var $menu          = array();
    var $stt           = -1;
    var $show_count    = 0;
    var $arrayCatId    = array();
    var $countId       = 1;
    var $arrayParent   = array();
    var $arrayCategory = array();
    var $level         = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    var $arrayCount    = array();

    public function sort($arrMenu, $parent = 0)
    {
        $arr = [];
        foreach ($arrMenu as $key => $item) {
            $arr[$item['parent_id']][$item['id']] = $item;
        }
        return $arr;
    }

    private function sortLevel($arrayCategory, $keyStart= 0, $level=-1)
    {
        if(array_key_exists($keyStart,$arrayCategory))
        {
            $level++;
            foreach($arrayCategory[$keyStart] as $key => $value)
            {
                // gán các phần tử cho array menu sắp xếp theo đúng vị trí
                $this->stt++;
                $this->menu[$this->stt] = $value;
                $this->menu[$this->stt]['level'] = $level;
                $this->menu[$this->stt]["parent"] = (array_key_exists($key,$arrayCategory)) ? 1 : 0;
                $this->sortLevel($arrayCategory, $key, $level);
            }
        }
    }
}
