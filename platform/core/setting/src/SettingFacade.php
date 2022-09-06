<?php
namespace Workable\Setting;


use Illuminate\Support\Facades\Facade;
use Workable\Setting\Supports\SettingStore;

class SettingFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return SettingStore::class;
    }
}
