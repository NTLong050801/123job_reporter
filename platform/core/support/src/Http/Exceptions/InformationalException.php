<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/04/21 - 11:26
 */

namespace Workable\Support\Http\Exceptions;


class InformationalException extends HttpException
{
    protected $codes = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing'
    );
}