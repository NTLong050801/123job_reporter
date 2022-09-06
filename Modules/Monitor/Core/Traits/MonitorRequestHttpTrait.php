<?php

namespace Modules\Monitor\Core\Traits;

trait MonitorRequestHttpTrait
{

    protected function _buildParam($paramQuery = [], $accessToken = "")
    {
        $paramQuery['access_token'] = $accessToken;

        return $paramQuery;
    }

    protected function _buildHeader($header = [])
    {
        return $header;
    }
}

