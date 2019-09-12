<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PlayerRepository;
use App\Validators\PlayerValidator;

use App\Player;
/**
 * Class PlayerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PlayerRepositoryEloquent extends BaseRepository implements PlayerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Player::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    

    public function bulkInsert($valuesToBeInserted){
        
        try {
            DB::beginTransaction();
            
            $playerModel = new $this->model();
            foreach ($valuesToBeInserted as $key => $value) {

                $value->player_id = $value->id;

                //Unset id so we dont replace id on the database
                unset($value->id);
                if(!is_array($value)){
                    $value =  (array) $value;
                }

                $playerModel->insert($value);
            }

            DB::commit();
            return true;

        } catch (Exception $e) {

            DB::rollback();
            return false;
        }
    }

}
