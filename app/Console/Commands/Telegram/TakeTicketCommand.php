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
        $ticket_model = $this->getTicket($ticket[2]);

        if($ticket_model){
            $data = [
                "theme" => $ticket_model->theme,
                "body" => $ticket_model->body
            ];

            $ticket_model->support_id = $user_id;
            $ticket_model->step = "resolving";
            $ticket_model->save();

            $this->sendCustomMessageToUser($ticket_model, $this->telegram, "*Ваше обращение принял администратор.* \nДля закрытия обращения напишите команду /close");
            $this->sendCustomMessageToAdmin($ticket_model, $this->telegram, "Вы приняли обращения от пользователя @".$ticket[1]." \n*Тема обращения:* ".$data["theme"]."\n*Обращение:* ".$data["body"]."\nДля закрытия обращения используйте команду /close_ticket");
        }
        else{
            $this->replyWithMessage([
                "text" => "Обращение с ID ".$ticket[2]." не найдено!",
            ]);
        }
    }

    private function getTicket($ticket_id)
    {
        $ticket_model_data = TelegramTicket::where("id", $ticket_id)->first();

        if($ticket_model_data)
            return $ticket_model_data;
        else
            return false;
    }
}
