<?php

namespace App\Services\PlayerAPI;

use Ixudra\Curl\Facades\Curl;
use App\Services\PlayerAPI\PlayerServices;

/**
 * Class PlayerService.
 *
 * @package namespace App\Services;
 */
class PlayerServicesJSON implements PlayerServices
{
    public function get()
    {
        $response = Curl::to('https://fantasy.premierleague.com/api/bootstrap-static/')
        ->returnResponseObject()
        ->asJson()
        ->get();
        return $response;
    }
}
