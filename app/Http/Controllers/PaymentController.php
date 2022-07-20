<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentOfServerRequest;
use App\Models\PaymentHistory;
use App\Models\Server;
use App\Models\ServerRating;
use App\Models\Yookassa;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use YooKassa\Client;
use YooKassa\Common\Exceptions\ApiException;
use YooKassa\Common\Exceptions\BadApiRequestException;
use YooKassa\Common\Exceptions\ExtensionNotFoundException;
use YooKassa\Common\Exceptions\ForbiddenException;
use YooKassa\Common\Exceptions\InternalServerError;
use YooKassa\Common\Exceptions\NotFoundException;
use YooKassa\Common\Exceptions\ResponseProcessingException;
use YooKassa\Common\Exceptions\TooManyRequestsException;
use YooKassa\Common\Exceptions\UnauthorizedException;
use YooKassa\Model\NotificationEventType;
use YooKassa\Request\Payments\CreatePaymentResponse;

class PaymentController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuth(config("yookassa.YOOKASSA_CLIENT_ID"), config("yookassa.YOOKASSA_CLIENT_SECRET"));
    }

    /**
     *
     * Создание платежа
     *
     * @param PaymentOfServerRequest $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function paymentCreate(PaymentOfServerRequest $request)
    {
        $server = Server::where("id", $request->server_id)->first();

        try {
            $payment = $this->client->createPayment([
                'amount' => [
                    'value' => (double)$request->price,
                    'currency' => 'RUB',
                ],
                'description' => "Оплата рекламы проекта '{$server->title}' на MNS Game Project",
                'capture' => true,
                'confirmation' => [
                    'type' => 'redirect',
                    'return_url' => route('payment.callback'),
                ],
                'metadata' => [
                    'server_id' => $server->id,
                ]
            ], $unique_id = uniqid('', true));

            $this->addInfoToDB($payment, $unique_id);

            Cookie::queue('payment_id', $payment->id, 180);
            Cookie::queue('uniq_id', $unique_id, 180);

            return redirect( $payment->getConfirmation()->getConfirmationUrl() );

        } catch (BadApiRequestException | ForbiddenException | InternalServerError | NotFoundException | ResponseProcessingException | TooManyRequestsException | UnauthorizedException | ApiException | ExtensionNotFoundException $e) {

            Log::error("YOOKASSA ERROR: ".$e->getMessage());

            $error = "На данный момент оплата недоступна, обратитесь к администрации.";

            return view("other.promote", compact("error"));
        }
    }

    /**
     *
     * Пользовательский редирект
     *
     */
    public function paymentCallback(){
        $payment_id = Cookie::get("payment_id");
        $uniq_id = Cookie::get("uniq_id");

        if($payment_id and $uniq_id != null){
            $payment = Yookassa::where("payment_id", $payment_id)->where("uniq_id", $uniq_id)->firstOrFail();

            try {
                $payment = $this->client->getPaymentInfo($payment->payment_id);
            } catch (BadApiRequestException | ForbiddenException | InternalServerError | NotFoundException | ResponseProcessingException | TooManyRequestsException | UnauthorizedException | ApiException | ExtensionNotFoundException $e) {
                Log::error("YOOKASSA ERROR: ".$e->getMessage());

                abort(500);
            }

            switch ($payment->status){
                case "succeeded":
                    return \view("payment.PAYMENT_SUCCEEDED");

                case "waiting_for_capture":
                    return \view("payment.PAYMENT_WAITING_FOR_CAPTURE");

                case "canceled":
                    return \view("payment.PAYMENT_CANCELED");

                default:
                    abort(404);
                    return 0;
            }
        }
        else{
            abort(404);
            return 0;
        }
    }

    /**
     *
     * Редирект от Яндекса
     *
     * @param Request $request
     */
    public function paymentCallbackYandex(Request $request){

        if(count($request->all()) <= 0){
            abort(404);
        }

        Yookassa::where("payment_id", $request->object["id"])->firstOrFail();

        if ($request->event == NotificationEventType::PAYMENT_SUCCEEDED) {
            if ($request->object['paid'] === true) {
                $server = $this->updateInfoDB($request->object);
                $this->addRatingToServer($server["server_id"], $server["sum"]);
                $this->addPaymentHistory($server["server_id"], $server["sum"], "rating");
            }
        } else if($request->event == NotificationEventType::PAYMENT_CANCELED) {
            $this->updateInfoDB($request->object);
        }
    }

    /**
     *
     * Добавление информации о создании платежа в БД
     *
     * @param CreatePaymentResponse $payment
     * @param $unique_id
     */
    private function addInfoToDB(CreatePaymentResponse $payment, $unique_id){
        Yookassa::insert([
            "server_id" => $payment->metadata->offsetGet("server_id"),
            "payment_id" => $payment->id,
            "status" => $payment->status,
            "paid" => false,
            "sum" => $payment->amount->value,
            "currency" => $payment->amount->currency,
            "payment_link" => $payment->confirmation->getConfirmationUrl(),
            "description" => $payment->description,
            "uniq_id" => $unique_id,
            "created_at" => Carbon::now()->toDateTime(),
            "updated_at" => Carbon::now()->toDateTime()
        ]);
    }

    /**
     *
     * Обновление информации платежа
     *
     * @param $data
     * @return array
     */
    private function updateInfoDB($data): array
    {
        $yookassa = Yookassa::where("payment_id", $data["id"])->firstOrFail();

        $yookassa->status = $data["status"];
        $yookassa->paid = $data["paid"];
        $yookassa->paid_at = Carbon::now()->toDateTimeString();

        $yookassa->save();

        return [
            "server_id" => $yookassa->server_id,
            "sum" => $yookassa->sum
        ];
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
     */
    private function addPaymentHistory($server_id, $rating, $type){
        $payment_history = new PaymentHistory();

        $payment_history->server_id = $server_id;
        $payment_history->balance_change = $rating;
        $payment_history->type = $type;
        $payment_history->end_date = Carbon::now()->addMonth()->toDateTimeString();
        $payment_history->is_active = false;

        $payment_history->save();
    }
}
