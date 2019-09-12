<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PlayerCreateRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Repositories\PlayerRepository;

/**
 * Class PlayersController.
 *
 * @package namespace App\Http\Controllers;
 */
class PlayersController extends Controller
{
    /**
     * @var PlayerRepository
     */
    protected $repository;

    /**
     * @var PlayerValidator
     */

    /**
     * PlayersController constructor.
     *
     * @param PlayerRepository $repository
     * @param PlayerValidator $validator
     */
    public function __construct(PlayerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $players = $this->repository->all();

        return response()->json([
            'data' => $players,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PlayerCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PlayerCreateRequest $request)
    {
        try {

            $player = $this->repository->create($request->all());

            $response = [
                'message' => 'Player created.',
                'data'    => $player->toArray(),
            ];

            return response()->json($response);
         
        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player =  $this->repository->findByField('player_id',$id);
        return response()->json([
            'data' => $player,
        ]);
  
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PlayerUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PlayerUpdateRequest $request, $id)
    {
        try {

            $player = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Player updated.',
                'data'    => $player->toArray(),
            ];

            return response()->json($response);
   
        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return response()->json([
            'message' => 'Player deleted.',
            'deleted' => $deleted,
        ]);

    }
}
