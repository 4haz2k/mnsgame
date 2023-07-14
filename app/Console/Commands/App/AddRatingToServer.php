<?php

namespace App\Console\Commands\App;

use App\Http\Interfaces\PaymentTypes;
use App\Http\Services\PaymentsHandler;
use App\Models\PaymentHistory;
use App\Models\Server;
use App\Models\ServerRating;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddRatingToServer extends Command
{
    protected $signature = 'server:add-rating
                            {server_id : server id}
                            {packet : packet}
                            {qty : quantity}';

    protected $description = 'Add rating to server';

    public function handle(): int
    {
        $paymentHandler = new PaymentsHandler($this->argument('packet'));

        // Начисление рейтинга в зависимости от выбранного типа услуги
        switch ($this->argument('packet')){
            case PaymentTypes::PACKET_RATING["title"]:
                $this->addRatingToServer(
                    $this->argument('server_id'),
                    $paymentHandler->getPacket()["price"] * (int)$this->argument('qty')
                );
                $this->addPaymentHistory($this->argument('server_id'), $paymentHandler->getPacket()["price"] * (int)$this->argument('qty'), $this->argument('packet'));
                break;
            case PaymentTypes::PACKET_RUBY["title"]:
                $this->addRatingToServer(
                    $this->argument('server_id'),
                    $paymentHandler->getRatingToSet()
                );
                $this->addPaymentHistory($this->argument('server_id'), $paymentHandler->getPacket()["price"], $this->argument('packet'), $paymentHandler->getTimeToSet());
                break;
            case PaymentTypes::PACKET_SAPPHIRE["title"]:
                $this->addRatingToServer(
                    $this->argument('server_id'),
                    $paymentHandler->getRatingToSet()
                );
                $this->addPaymentHistory($this->argument('server_id'), $paymentHandler->getPacket()["price"], $this->argument('packet'));
                break;
            case PaymentTypes::PACKET_EMERALD["title"]:
                $this->addRatingToServer(
                    $this->argument('server_id'),
                    $paymentHandler->getRatingToSet()
                );
                $this->addPaymentHistory($this->argument('server_id'), $paymentHandler->getPacket()["price"], $this->argument('packet'));
                $this->setChartServer($this->argument('server_id'));
                break;
        }

        return self::SUCCESS;
    }

    /**
     *
     * Начисление рейтинга серверу
     *
     * @param $server_id
     * @param $rating
     */
    private function addRatingToServer($server_id, $rating){
        $server_rating = ServerRating::where("server_id", $server_id)->first();

        if($server_rating == null){
            $server_rating = new ServerRating();
            $server_rating->server_id = $server_id;
            $server_rating->rating = $rating;
        }
        else{
            $server_rating->rating += $rating;
        }

        $server_rating->save();
    }

    /**
     *
     * Добавление истории платежа
     *
     * @param $server_id
     * @param $rating
     * @param $type
     * @param null $endDate
     * @return PaymentHistory
     */
    private function addPaymentHistory($server_id, $rating, $type, $endDate = null): PaymentHistory
    {
        $payment_history = new PaymentHistory();

        $payment_history->server_id = $server_id;
        $payment_history->balance_change = $rating;
        $payment_history->type = $type;
        if($endDate){
            if($endDate == "1 week"){
                $payment_history->end_date = Carbon::now()->addWeek()->toDateTimeString();
            }
            else{
                $payment_history->end_date = Carbon::now()->addMonth()->toDateTimeString();
            }
        }
        else{
            $payment_history->end_date = Carbon::now()->addMonth()->toDateTimeString();
        }
        $payment_history->is_active = false;

        $payment_history->save();

        return $payment_history;
    }

    /**
     *
     * Добавить график серверу
     *
     * @param $server_id
     */
    private function setChartServer($server_id){
        $server = Server::where("id", $server_id)->first();
        $server->chart = true;
        $server->save();
    }
}
