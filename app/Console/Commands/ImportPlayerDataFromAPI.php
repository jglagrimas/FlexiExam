<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PlayerAPI\PlayerServices;
use App\Repositories\PlayerRepository;


class ImportPlayerDataFromAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'playerAPI:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Player Data from api';

    protected $playerServices;
    protected $playerRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PlayerServices $playerService , 
                                PlayerRepository $playerRepository
                            )
    {
        parent::__construct();
        $this->playerRepository = $playerRepository;
        $this->playerServices = $playerService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            
            $response = $this->playerServices->get();
            $this->playerRepository->bulkInsert($response->content->elements);

            $this->info('Success importing players.');

        } catch (Exception $e) {

            $this->error('Something went wrong.');
        }
       
    }
}
