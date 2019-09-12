<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\PlayerAPI\PlayerServicesJSON;
use App\Repositories\PlayerRepositoryEloquent;
use Mockery;


class PlayerFunctionalityTest extends TestCase
{

	use RefreshDatabase;

  	protected $playerServices;
    protected $playerRepository;

    public function setUp() : void
    {
    	parent::setUp();
        $this->playerRepository = new PlayerRepositoryEloquent($this->app);
        $this->playerServices = new PlayerServicesJSON;
    }

    /**
     * testing the full cycle of importing players from api to database.
     *
     * @return void
     */
    public function test_can_import_data_from_api_to_database()
    {
	    $response = $this->playerServices->get();
        $this->assertTrue($this->playerRepository->bulkInsert($response->content->elements));
    }
}
