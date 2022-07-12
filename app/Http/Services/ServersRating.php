<?php

namespace App\Http\Services;


use App\Models\PaymentHistory;
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
                $server_rating = ServersRating::where("server_id", $server_payment->server_id)->first();

                if($server_rating != null){
                    $server_rating->rating -= $server_payment->balance_change;
                    $server_rating->save();
                    $server_payment->is_active = true;
                    $server_payment->save();
                }
            }
        }
    }
}
