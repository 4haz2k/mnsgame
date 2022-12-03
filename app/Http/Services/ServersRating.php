<?php

namespace App\Http\Services;


use App\Http\Interfaces\PaymentTypes;
use App\Models\PaymentHistory;
use App\Models\Server;
use App\Models\ServerRating;
use Carbon\Carbon;

class ServersRating
{
    private $servers_payment;

    public function __construct()
    {
        $this->servers_payment = PaymentHistory::where("is_active", false)->where("end_date", "<", Carbon::now()->toDateTimeString())->get();
    }

    public function updateRating(){
        if($this->servers_payment->isNotEmpty()){
            foreach ($this->servers_payment as $server_payment) {
                $server_rating = ServerRating::where("server_id", $server_payment->server_id)->first();

                if($server_rating != null){
                    switch ($server_payment->type) {
                        case PaymentTypes::packets[0]:
                            $server_rating->rating -= $server_payment->balance_change;
                            break;
                        case PaymentTypes::packets[1]:
                            $server_rating->rating -= 150;
                            break;
                        case PaymentTypes::packets[2]:
                            $server_rating->rating -= 200;
                            break;
                        case PaymentTypes::packets[3]:
                            $server_rating->rating -= 300;
                            break;
                    }
                    $server_rating->save();
                    $server_payment->is_active = true;
                    $server_payment->save();
                }

                if($server_payment->type != PaymentTypes::packets[0]){
                    $server = Server::where("server_id", $server_payment->server_id)->first();
                    $server->background = null;

                    if($server_payment->type == PaymentTypes::packets[3]){
                        $server->chart = false;
                    }

                    $server->save();
                }
            }
        }
    }
}
