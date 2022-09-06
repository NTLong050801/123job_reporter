<?php
if (!function_exists('platform_path')) {
    /**
     * @return string
     * @author HungNguyen
     */
    function platform_path($path = null)
    {
        return base_path('platform' . DIRECTORY_SEPARATOR . $path);
    }
}

if (!function_exists('plugin_path')) {
    /**
     * @return string
     * @author HungNguyen
     */
    function plugin_path($path = null)
    {
        return platform_path('plugins' . DIRECTORY_SEPARATOR . $path);
    }
}

if (!function_exists('analyzer_path')) {
    /**
     * @return string
     * @author HungNguyen
     */
    function analyzer_path($path = null)
    {
        return platform_path('analyzer' . DIRECTORY_SEPARATOR . $path);
    }
}


if (! function_exists('asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function asset($path, $secure = null)
    {
        return app('url')->url($path, $secure);
    }
}


if (!function_exists('cdn'))
{
    // global CDN link helper function
    function cdn( $asset ){

        // Verify if KeyCDN URLs are present in the config file
        if( !\Illuminate\Support\Facades\Config::get('cdn.cdn'))
        {
            return asset( $asset );
        }

        // Get file name incl extension and CDN URLs
        $cdns = \Illuminate\Support\Facades\Config::get('cdn.cdn');
        $assetName = basename( $asset );

        // Remove query string
        $assetName = explode("?", $assetName);
        $assetName = $assetName[0];

        // Select the CDN URL based on the extension
        foreach( $cdns as $cdn => $types ) {
            if( preg_match('/^.*\.(' . $types . ')$/i', $assetName) )
                return cdnPath($cdn, $asset);
        }

        // In case of no match use the last in the array
        end($cdns);
        return cdnPath( key( $cdns ) , $asset);
    }
}

if (!function_exists('cdnPath'))
{
    function cdnPath($cdn, $asset) {
        return  "//" . rtrim($cdn, "/") . "/" . ltrim( $asset, "/");
    }
}


function check_db_conn()
{
    try {
        DB::connection(config('database.default'))->reconnect();
        return true;
    }catch (Exception $e)
    {
        return false;
    }
}

if (!function_exists('get_active_plugins')) {
    function get_active_plugins()
    {
        return setting('activated_plugins', '[]');
    }
}

if (!function_exists('get_active_analyzer')) {
    function get_active_analyzer()
    {
        return setting('activated_analyzers', '[]');
    }
}


