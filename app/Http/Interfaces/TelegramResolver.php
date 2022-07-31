<?php


namespace App\Http\Interfaces;


use App\Models\TelegramTicket;
use Telegram\Bot\Objects\Update;

class TelegramResolver
{
    use TelegramChecker;

    public function resolverHandler($user_id, Update $updates, $telegram){
        $ticket = $this->getTicket($user_id);
        switch ($ticket->step){
            case "theme":
                $this->saveTheme($ticket, $updates->message->text);
                return "*Введите обращение*";
            case "body":
                $this->saveBody($ticket, $updates->message->text);
                $this->sendToSupport($telegram, $updates);
                return "*Обращение создано, ожидайте ответ администратора.* \n\nДата и время регистрации обращения: *".date("d.m.Y H:i:s")."*";
            case "resolving":
                $this->sendMessageToAdmin($ticket, $updates, $telegram);
                return false;
            default:
                return false;
        }
    }

    private function getTicket($user_id){
       return TelegramTicket::where("user_id", $user_id)->where("step", "!=", "closed")->where("step", "!=", "waiting")->first();
    }

    private function saveTheme(TelegramTicket $ticket, $message){
        $ticket->theme = $message;
        $ticket->step = "body";
        $ticket->save();
    }

    private function saveBody(TelegramTicket $ticket, $message){
        $ticket->body = $message;
        $ticket->step = "waiting";
        $ticket->is_creating = false;
        $ticket->save();
    }
}
