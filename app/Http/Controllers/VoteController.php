<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\ServerRates;
use Carbon\Carbon;
use http\Client\Response;
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

        if($server->callback != null){
            $this->sendCallback($server->callback, request("nickname"), $server->hash);
        }

        return response()->json(["message" => "Голос засчитан"]);
    }

    private function sendCallback($url, $nickname, $hash): bool
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
        curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body

        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query([
                'nickname' => $nickname,
                'hash' => $hash
            ]));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);

        curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if($http_code === 200)
            return true;
        else
            return false;
    }
}
