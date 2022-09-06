<?php


namespace Workable\Setting\Supports;


use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Manager;
use Workable\Setting\Driver\DatabaseSettingStore;
use Workable\Setting\Driver\JsonSettingStore;

class SettingManager extends Manager
{
    protected $container;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->container = $app;
    }

    public function getDefaultDriver()
    {
        return env('CMS_SETTING_STORE_DRIVER') ?? config('platform.cms_setting_store_driver');
    }

    public function createJsonDriver()
    {
        return new JsonSettingStore($this->container['files']);
    }

    public function createDatabaseDriver()
    {
        $connection = $this->container->make(DatabaseManager::class)->connection();
        $table = 'settings';
        $keyColumn = 'key';
        $valueColumn = 'value';
        return new DatabaseSettingStore($connection, $table, $keyColumn, $valueColumn);
    }
}
