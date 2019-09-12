<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\PlayerAPI\PlayerServicesJSON;


class PlayersAPITest extends TestCase
{
    /**
     * testing api call for getting players
     *
     * @return void
     */
    public function test_can_get_players_api_JSON()
    {   
        $expectedStatusCode = 200;

        $playerServices = new PlayerServicesJSON();
        $response = $playerServices->get();

        $this->assertEquals($response->status, $expectedStatusCode);
    }


}
