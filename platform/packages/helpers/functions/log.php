<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 7/11/19
 * Time: 16:09
 */

if (!function_exists('get_data_exception'))
{
    function get_data_exception(Exception $e)
    {
        return 'File:'. $e->getFile(). "\n".
            'Line:'. $e->getLine(). "\n".
            'Code:'. $e->getCode(). "\n".
            'Message:'. $e->getMessage();
    }
}

if (!function_exists('log_error_exception'))
{
    function log_error_exception(Exception $e)
    {
        $data = get_data_exception($e);
        \Log::error($data);
    }
}

if (!function_exists('log_warning_exception'))
{
    function log_warning_exception(Exception $e)
    {
        $data = get_data_exception($e);
        \Log::warning($data);
    }
}


if (!function_exists('cli_warning_nl'))
{
    function cli_warning_nl(Exception $e)
    {
        \CliEcho::warningnl(get_data_exception($e));
    }
}

if (!function_exists('cli_success_nl'))
{
    function cli_success_nl(Exception $e)
    {
        \CliEcho::successnl(get_data_exception($e));
    }
}

if (!function_exists('cli_info_nl'))
{
    function cli_info_nl(Exception $e)
    {
        \CliEcho::infonl(get_data_exception($e));
    }
}
