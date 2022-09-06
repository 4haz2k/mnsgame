<?php

namespace App\Http\Services;

use App\Models\ServerRates;
use Carbon\Carbon;

class ServersVote
{
    private $serversVotes;

    public function __construct()
    {
        $this->serversVotes = ServerRates::all();
    }

    public function updateVotes(){
        foreach ($this->serversVotes as $serverVote){
            if(Carbon::createFromFormat("Y-m-d H:i:s", $serverVote->vote_time) <= Carbon::now()->subMonth()){
                $serverVote->delete();
            }
        }
    }
}
