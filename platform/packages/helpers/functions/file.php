<?php
if (!function_exists('get_file_content_to_array'))
{
    function get_file_content_to_array($file = '')
    {
        $handle = fopen($file, "r");
        $arr = [];
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (strpos($line, '#') === 0) {
                    continue;
                } else {
                    array_push($arr, trim($line));
                }
            }
        }
        fclose($handle);
        return $arr;
    }
}


if (!function_exists('get_file_data')) {
    /**
     * @param $file
     * @param $convert_to_array
     * @return bool|mixed
     * @author Sang Nguyen
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function get_file_data($file, $convert_to_array = true)
    {
        $file = File::get($file);
        if (!empty($file)) {
            if ($convert_to_array) {
                return json_decode($file, true);
            } else {
                return $file;
            }
        }
        if (!$convert_to_array) {
            return null;
        }
        return [];
    }
}


if (!function_exists('get_data_module')) {
    function get_data_module($path, $module)
    {
        $path = base_path('Modules' . DIRECTORY_SEPARATOR . $module . "/Database/".$path.'.json');
        $data = file_get_contents($path);
        return json_decode($data, true);
    }
}

if (!function_exists('script_src'))
{
    /**
     * @param $path
     * @param string $manifestDirectory
     * @return string
     * @throws Exception
     */
    function script_src($path, $manifestDirectory = '')
    {
        if (!$manifestDirectory)
        {
            return '<script src="'.asset($path).'"></script>';
        }else
        {
            return '<script src="'.mix($path, $manifestDirectory).'"></script>';
        }
    }
}

if (!function_exists('css_src'))
{
    /**
     * @param $path
     * @param string $manifestDirectory
     * @return string
     * @throws Exception
     */
    function css_src($path, $manifestDirectory = '')
    {
        if (!$manifestDirectory)
        {
            return '<link rel="stylesheet" href="'.asset($path).'">';
        }else
        {
            return '<link rel="stylesheet" href="'.mix($path, $manifestDirectory).'">';
        }
    }
}
