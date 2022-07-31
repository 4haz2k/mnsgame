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
                "text" => "Необходимо ввести пользователя и ID обращения в формате /take @user 12345"
            ]);
            return;
        }

        if($this->checkIsAdminTakedTicket($user_id)){
            $this->replyWithMessage([
                "text" => "Вы уже отвечаете на обращение!"
            ]);
            return;
        }

        if($ticket_model = $this->getTicketData($ticket[2])){
            $this->updateTicket($ticket_model, $user_id);
            $this->sendCustomMessageToUser($ticket_model, $this->telegram, "*Ваше обращение принял администратор.* \nДля закрытия обращения напишите команду /close");
            $this->sendCustomMessageToAdmin($ticket_model, $this->telegram, $ticket[1]);
            $this->replyWithMessage([
                "text" => "Обработка обращения принята! Перейдите в бота @mnsgame_bot для общения с пользователем.",
            ]);
        }
        else{
            $this->replyWithMessage([
                "text" => "Обращение с ID ".$ticket[2]." не найдено!",
            ]);
        }
    }
}
