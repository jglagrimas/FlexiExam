<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Player;

class PlayersEndPointTest extends TestCase
{

    use RefreshDatabase;

    /**
     * getting all player details for end point.
     *
     * @return void
     */
    public function test_can_get_all_players()
    {
        $playerResult = factory(Player::class,10)->create();
        $totalPlayer = Player::count();

        $response = $this->get('/api/player');

        $response->assertStatus(200) 
        ->assertJsonCount($totalPlayer, 'data');
    }

    /**
     * getting specific player details by player_id.
     *
     * @return void
     */
    public function test_can_get_specific_player_details()
    {
        $playerResult = factory(Player::class)->create();
        $response = $this->json('GET', '/api/player/'.$playerResult->player_id);
        
        $response->assertStatus(200) 
        ->assertJsonFragment([
            'player_id' => $playerResult->player_id
        ]);
    }
}
