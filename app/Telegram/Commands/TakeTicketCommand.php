<?php


namespace App\Telegram\Commands;


use App\Http\Interfaces\TelegramChecker;
use App\Telegram\Enum\TelegramCommand;
use App\Telegram\Enum\TelegramMessage;
use Telegram\Bot\Commands\Command;

class TakeTicketCommand extends Command
{
    use TelegramChecker;

    protected $name = TelegramCommand::TAKE;

    protected $description = TelegramCommand::TAKE_DESCRIPTION;

    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($updates->message->from);

        $ticket = explode(" ", $updates->message->text);

        if(!isset($ticket[1]) and !isset($ticket[2])){
            $this->replyWithMessage([
                "text" => TelegramMessage::WRONG_TAKE_COMMAND
            ]);
            return;
        }

        if($this->checkIsAdminTakedTicket($user_id)){
            $this->replyWithMessage([
                "text" => TelegramMessage::ALREADY_ANSWERED
            ]);
            return;
        }

        if($ticket_model = $this->getTicketData($ticket[2])){
            $this->updateTicket($ticket_model, $user_id);
            $this->sendCustomMessageToUser($ticket_model, $this->telegram, TelegramMessage::TICKET_CLAIMED_BY_ADMIN);
            $this->sendCustomMessageToAdmin($ticket_model, $this->telegram, $ticket[1]);
            $this->replyWithMessage([
                "text" => TelegramMessage::YOU_CLAIMED_TICKET,
            ]);
        }
        else{
            $this->replyWithMessage([
                "text" => TelegramMessage::TicketNotFound($ticket[2]),
            ]);
        }
    }
}
