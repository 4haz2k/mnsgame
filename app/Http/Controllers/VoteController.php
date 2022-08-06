<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\ServerRates;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
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
        $client = new Client();

        try{
            $promise = $client->request('POST', $url, [
                'form_params' => [
                    'nickname' => $nickname,
                    'hash' => $hash,
                    'time' => time()
                ]
            ]);
            if($promise->getStatusCode() == 200){
                return true;
            }
            else{
                return false;
            }
        }
        catch (ConnectException|GuzzleException $exception){
            return false;
        }
    }
}
