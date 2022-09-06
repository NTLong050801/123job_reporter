<?php
if (!function_exists('setting'))
{
    function setting($key = null, $default = null)
    {
        if (!empty($key))
        {
            try {
                return Setting::get($key, $default);
            }catch (Exception $ex)
            {
                return $default;
            }
        }

        return \Workable\Setting\SettingFacade::getFacadeRoot();
    }
}
