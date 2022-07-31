<?php


namespace App\Http\Interfaces;


use App\Models\TelegramLog;
use App\Models\TelegramSupporters;
use App\Models\TelegramTicket;
use App\Models\TelegramUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\Update;

trait TelegramChecker
{
    /**
     *
     * Регистрация пользователя
     *
     * @param $userTg
     * @return mixed
     */
    private function registerUser($userTg){
        $user = TelegramUser::where("login", $userTg->username)->first();

        if($user == null){
            $user = new TelegramUser();
            $user->login = $userTg->username;
            $user->firstName = $userTg->firstName;
            $user->lastName = $userTg->lastName;
            $user->save();
        }

        return $user->id;
    }


    /**
     *
     * Проверка активных тикетов
     *
     * @param $user_id
     * @return bool
     */
    private function checkActiveTickets($user_id): bool
    {
        $ticket = TelegramTicket::where("user_id", $user_id)->where("is_creating", true)->first();

        if($ticket)
            return true;
        else
            return false;
    }

    /**
     *
     * Проверка решающихся тикетов
     *
     * @param $user_id
     * @return bool
     */
    private function checkResolvingTickets($user_id): bool
    {
        $ticket = TelegramTicket::where("user_id", $user_id)->where("step", "resolving")->first();

        if($ticket)
            return true;
        else
            return false;
    }

    /**
     *
     * Регистрация логов
     *
     * @param $user_id
     * @param Update $updates
     */
    private function registerLog($user_id, Update $updates){
        $log = new TelegramLog();

        $log->user_id = $user_id;
        $log->message = $updates->message->text;
        $log->chat_id = $updates->message->chat->id;
        $log->date = Carbon::createFromTimestamp($updates->message->date)->toDateTimeString();

        $log->save();
    }

    private function sendMessageToAdmin(TelegramTicket $ticket, Update $updates, Api $telegram, bool $is_bot = false, string $message = null){
        $supporter = TelegramSupporters::where("id", $ticket->support_id)->first();

        if($is_bot){
            try {
                $telegram->sendMessage([
                    "chat_id" => $supporter->chat_id,
                    "text" => $message,
                    "parse_mode" => 'markdown'
                ]);
            } catch (TelegramSDKException $e) {
            }
        }
        else{
            try {
                $telegram->forwardMessage([
                    "chat_id" => $supporter->chat_id,
                    "from_chat_id" => $updates->message->chat->id,
                    "message_id" => $updates->message->messageId
                ]);
            } catch (TelegramSDKException $e) {
            }
        }
    }

    private function sendMessageToUser($ticket, Update $updates, Api $telegram, bool $is_bot = false, string $message = null){
        if($is_bot){
            try {
                $telegram->sendMessage([
                    "chat_id" => $updates->message->chat->id,
                    "text" => $message,
                    "parse_mode" => 'markdown'
                ]);
            } catch (TelegramSDKException $e) {
            }

        }
        else{
            try {
                $telegram->sendMessage([
                    "chat_id" => $ticket->chat_id,
                    "text" => $updates->message->text
                ]);
            } catch (TelegramSDKException $e) {
            }
        }
    }

    private function sendCustomMessageToUser($ticket, Api $telegram, string $message){
        try {
            $telegram->sendMessage([
                "chat_id" => $ticket->chat_id,
                "text" => $message,
                "parse_mode" => 'markdown'
            ]);
        } catch (TelegramSDKException $e) {
        }
    }

    private function sendCustomMessageToAdmin($ticket, Api $telegram, string $message){
        $supporter = TelegramSupporters::where("id", $ticket->support_id)->first();

        $message = "Вы приняли обращения от пользователя ".$message." \n\nТема обращения: ".$ticket->theme."\n\nОбращение: ".$ticket->body."\n\nДля закрытия обращения используйте команду /close_ticket";

        try {
            $telegram->sendMessage([
                "chat_id" => $supporter->chat_id,
                "text" => $message,
            ]);
        } catch (TelegramSDKException $e) {
        }
    }

    private function sendToSupport(Api $telegram, Update $update){
        try {
            $telegram->sendMessage([
                "chat_id" => -639796455,
                "text" => "Новое обращение от @" . $update->message->from->username . " \nЧтобы принять обращение, напишите /take @" . $update->message->from->username,
                "parse_mode" => 'markdown'
            ]);
        } catch (TelegramSDKException $e) {
        }
    }

    private function checkIsUserSupporter($user_id)
    {
        $supporter = TelegramSupporters::where("id", $user_id)->first();

        if ($supporter)
            return true;
        else
            return false;
    }

    private function checkIsAdminTakedTicket($user_id){
        $tickets = TelegramTicket::where("support_id", $user_id)->where("step", "resolving")->first();

        if($tickets){
            return $tickets;
        }
        else{
            return false;
        }
    }

    private function getTicketData($ticket_id)
    {
        $ticket_model_data = TelegramTicket::where("id", $ticket_id)->first();

        if($ticket_model_data)
            return $ticket_model_data;
        else
            return false;
    }

    private function updateTicket(TelegramTicket $ticket, $user_id){
        $ticket->support_id = $user_id;
        $ticket->step = "resolving";
        $ticket->save();
    }

    private function closeTicketInAdmin($user_id){
        $ticket = TelegramTicket::where("support_id", $user_id)->where("step", "resolving")->first();

        $ticket->step = "closed";

        $ticket->save();

        return $ticket->chat_id;
    }

    private function closeTicketInUser($user_id){
        $ticket = TelegramTicket::where("user_id", $user_id)->where("step", "resolving")->first();

        $ticket->step = "closed";

        $ticket->save();

        $supporter = TelegramSupporters::where("id", $ticket->support_id)->first();

        return $supporter->chat_id;
    }
}
