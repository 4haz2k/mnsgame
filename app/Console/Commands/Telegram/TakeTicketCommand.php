<?php


namespace App\Console\Commands\Telegram;


use App\Http\Interfaces\TelegramChecker;
use App\Models\TelegramTicket;
use Telegram\Bot\Commands\Command;

class TakeTicketCommand extends Command
{
    use TelegramChecker;

    protected $name = "take";

    protected $description = "Ответить на обращение";

    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($updates->message->from);

        $ticket = explode(" ", $updates->message->text);

        if(!isset($ticket[1]) and !isset($ticket[2])){
            $this->replyWithMessage([
                "text" => "Необходимо ввести пользователя и ID обращения в формате /take @user 12345!"
            ]);
            return;
        }

        if($this->checkIsAdminTakedTicket($user_id)){
            $this->replyWithMessage([
                "text" => "Вы уже отвечаете на обращение!"
            ]);
            return;
        }

        if($ticket_model = $this->getTicket($ticket[2])){
            $ticket_model->support_id = $user_id;
            $ticket_model->step = "resolving";
            $ticket_model->save();

            $this->sendMessageToUser($ticket_model, $updates, $this->telegram, false, "*Ваше обращение принял администратор.* \nДля закрытия обращения напишите команду /close");
            $this->sendMessageToAdmin($ticket_model, $updates, $this->telegram, true,
                "Вы приняли обращения от пользователя @".$ticket[1]." \n\n*Тема обращения: ".$ticket_model->theme."\n\nОбращение: ".$ticket_model->body."*"."\n\nДля закрытия обращения используйте команду /close_ticket"
            );
        }
        else{
            $this->replyWithMessage([
                "text" => "*Обращение с ID ".$ticket[2]." не найдено!",
            ]);
        }
    }

    private function getTicket($ticket_id)
    {
        $ticket = TelegramTicket::where("id", $ticket_id)->first();

        if($ticket)
            return $ticket;
        else
            return false;
    }
}
