<?php

namespace App\Telegram\Service;

use App\Models\TelegramLog;
use App\Models\TelegramSupporters;
use App\Models\TelegramTicket;
use App\Models\TelegramUser;
use App\Telegram\Enum\TelegramMessage;
use App\Telegram\Enum\TelegramRoles;
use App\Telegram\Enum\TelegramTicketStatus;
use Carbon\Carbon;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\Update;

trait TelegramChecker
{
    /**
     *
     * Регистрация пользователя
     *
     * @return mixed
     */
    private function registerUser($telegramUser){
        $user = TelegramUser::where("login", $telegramUser->username)->first();

        if($user == null){
            $user = new TelegramUser();
            $user->login = $telegramUser->username;
            $user->firstName = $telegramUser->firstName;
            $user->lastName = $telegramUser->lastName;
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
    public static function checkActiveTickets($user_id): bool
    {
        return (bool)TelegramTicket::where("user_id", $user_id)->where("is_creating", true)->first();
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
        $ticket = TelegramTicket::where("user_id", $user_id)->where("step", TelegramTicketStatus::RESOLVING)->first();

        if($ticket)
            return true;
        else
            return false;
    }

    /**
     *
     * Регистрация логов
     *
     */
    private function registerLog(): void
    {
        $log = new TelegramLog();

        $log->user_id = $this->user_id;
        $log->message = $this->updates->message->text;
        $log->chat_id = $this->updates->message->chat->id;
        $log->date = Carbon::createFromTimestamp($this->updates->message->date)->toDateTimeString();

        $log->save();
    }

    private function sendMessageToAdmin(TelegramTicket $ticket, Update $updates, Api $telegram, bool $is_bot = false, string $message = null)
    {
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

    private function sendMessageToUser($ticket, Update $updates, Api $telegram, bool $is_bot = false, string $message = null)
    {
        if($is_bot) {
            try {
                $telegram->sendMessage([
                    "chat_id" => $updates->message->chat->id,
                    "text" => $message,
                    "parse_mode" => 'markdown'
                ]);
            } catch (TelegramSDKException $e) {}

        } else {
            try {
                $telegram->sendMessage([
                    "chat_id" => $ticket->chat_id,
                    "text" => $updates->message->text
                ]);
            } catch (TelegramSDKException $e) {}
        }
    }

    private function sendCustomMessageToUser($ticket, Api $telegram, string $message){
        try {
            $telegram->sendMessage([
                "chat_id" => $ticket->chat_id,
                "text" => $message,
                "parse_mode" => 'markdown'
            ]);
        } catch (TelegramSDKException $e) {}
    }

    private function sendCustomMessageToAdmin($ticket, Api $telegram, string $user){
        $supporter = TelegramSupporters::where("id", $ticket->support_id)->first();

        $message = TelegramMessage::TookTicket($user, $ticket->theme, $ticket->body);

        try {
            $telegram->sendMessage([
                "chat_id" => $supporter->chat_id,
                "text" => $message,
            ]);
        } catch (TelegramSDKException $e) {}
    }

    private function sendToSupport(Api $telegram, Update $update, $ticket_id){
        try {
            $telegram->sendMessage([
                "chat_id" => -639796455,
                "text" => TelegramMessage::NewTicket($update->message->from->username, $ticket_id),
                "parse_mode" => 'markdown'
            ]);
        } catch (TelegramSDKException $e) {}
    }

    private function checkIsUserSupporter($user_id): string
    {
        return TelegramSupporters::where("id", $user_id)->first() ? TelegramRoles::ADMIN : TelegramRoles::USER;
    }

    public static function checkIsAdminTookTicket($user_id)
    {
        return TelegramTicket::where("support_id", $user_id)->where("step", TelegramTicketStatus::RESOLVING)->first() ?: false;
    }

    private function getTicketData($ticket_id)
    {
        return TelegramTicket::where("id", $ticket_id)->first() ?: false;
    }

    private function updateTicket(TelegramTicket $ticket, $user_id){
        $ticket->support_id = $user_id;
        $ticket->step = TelegramTicketStatus::RESOLVING;
        $ticket->save();
    }

    private function closeTicketInAdmin($user_id)
    {
        $ticket = TelegramTicket::where("support_id", $user_id)->where("step", TelegramTicketStatus::RESOLVING)->first();

        $ticket->step = TelegramTicketStatus::CLOSED;

        $ticket->save();

        return $ticket->chat_id;
    }

    private function closeTicketInUser($user_id){
        $ticket = TelegramTicket::where("user_id", $user_id)->where("step", TelegramTicketStatus::RESOLVING)->first();

        $ticket->step = TelegramTicketStatus::CLOSED;

        $ticket->save();

        $supporter = TelegramSupporters::where("id", $ticket->support_id)->first();

        return $supporter->chat_id;
    }
}
