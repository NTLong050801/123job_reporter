<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 2022/02/28 - 14:24
 */

namespace Modules\Collect\Core\Traits;


trait CrawlRequestHttpTrait
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
