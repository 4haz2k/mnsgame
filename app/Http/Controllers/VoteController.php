<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\ServerRates;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     * AJAX: vote project
     *
     * @param $server_id
     * @return JsonResponse
     */
    public function addVote($server_id): JsonResponse
    {
        $server = Server::where("id", $server_id)->first();

        if(!$server){
            return response()->json(["message" => "Данного сервера не существует!", "code" => 0], 422);
        }

        if($server->owner_id == Auth::id()){
            return response()->json(["message" => "Нельзя проголосовать за свой проект!", "code" => 1], 422);
        }

        $previous_rate =
            ServerRates::where("voter_id", "=", Auth::id())
            ->where("server_id", "=", $server_id)
            ->where("vote_time", ">", Carbon::yesterday()->toDateTimeString())
            ->first();

        if($previous_rate){
            return response()->json(["message" => "Голосовать за один проект можно только один раз за 24 часа!", "code" => 2], 422);
        }

        $vote = new ServerRates();
        $vote->voter_id = Auth::id();
        $vote->server_id = $server_id;
        $vote->vote_time = Carbon::now()->toDateTimeString();
        $vote->save();

        return response()->json(["message" => "Голос засчитан"]);
    }
}
