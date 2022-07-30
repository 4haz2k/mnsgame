<?php


namespace App\Http\Interfaces;


use App\Models\TelegramLog;
use App\Models\TelegramSupporters;
use App\Models\TelegramTicket;
use App\Models\TelegramUser;
use Carbon\Carbon;
use Telegram\Bot\Api;
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
        $log->date = Carbon::createFromTimestamp($updates->message->date)->toDateTimeString();

        $log->save();
    }

    private function sendMessageToAdmin(TelegramTicket $ticket, Update $updates, Api $telegram, bool $is_bot = false, string $message = null){
        $supporter = TelegramSupporters::where("id", $ticket->support_id)->first();

        if($is_bot){
            $telegram->sendMessage([
                "chat_id" => $supporter->chat_id,
                "text" => $message,
                "parse_mode" => 'markdown'
            ]);
        }
        else{
            $telegram->forwardMessage([
                "chat_id" => $supporter->chat_id,
                "from_chat_id" => $updates->message->chat->id,
                "message_id" => $updates->message->messageId
            ]);
        }
    }

    private function sendMessageToUser($ticket, Update $updates, Api $telegram, bool $is_bot = false, string $message = null){
        if($is_bot){
            $telegram->sendMessage([
                "chat_id" => $updates->message->chat->id,
                "text" => $message,
                "parse_mode" => 'markdown'
            ]);
        }
        else{
            $telegram->sendMessage([
                "chat_id" => $ticket->chat_id,
                "text" => $updates->message->text,
                "parse_mode" => 'markdown'
            ]);
        }
    }

    private function sendToSupport(Api $telegram, Update $update){
        $telegram->sendMessage([
            "chat_id" => -639796455,
            "text" => "Новое обращение от @".$update->message->from->username." \nЧтобы принять обращение, напишите /take @".$update->message->from->username,
            "parse_mode" => 'markdown'
        ]);
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
        $tickets = TelegramTicket::where("support_id", $user_id)->where("step", "resolving")->get();

        if($tickets->isNotEmpty()){
            return true;
        }
        else{
            return false;
        }
    }
}
