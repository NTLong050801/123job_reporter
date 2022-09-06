<?php

namespace Workable\AuditLog\Services;

use Jenssegers\Agent\Agent;
use Workable\AuditLog\Repository\HistoryLogin\HistoryLoginRepositoryInterface;
use Torann\GeoIP\Facades\GeoIP;

class HistoryLoginService
{
    protected $historyRepository;

    public function __construct(HistoryLoginRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }
    public function list($filter = false, $sort = false, $paginate = 20)
    {
        $items = $this->historyRepository->list($filter, $sort, $paginate);
        return $items;
    }
    public function insertLogin($ip = null)
    {
        $agent                     = new Agent();
        $login['admin_id']         = get_data_user('admins', 'id');
        $login['device']           = $agent->device();
        $login['platform']         = $agent->platform();
        $login['platform_version'] = $agent->version($agent->platform()) ? $agent->version($agent->platform()) : null;
        $login['browser']          = $agent->browser();
        $login['browser_version']  = $agent->version($agent->browser());
        $login['ip']               = $ip;
        //$geoip = Location::get($request->ip());
        $geoip                     = GeoIP::getLocation($ip);
        $login['city'] = $geoip['city'];
        // $login['region_code'] = $geoip['regionCode'];
        //$login['region_name'] = $geoip['regionName'];
        $login['country_code']   = $geoip['iso_code'];
        $login['country_name']   = $geoip['country'];
        $login['continent_code'] = $geoip['continent'];
        $login['continent_name'] = $geoip['timezone'];
        $login['latitude']       = $geoip['lat'];
        $login['longitude']      = $geoip['lon'];
        $login['created_at']     = now();
        $this->historyRepository->insert($login);
    }
}
