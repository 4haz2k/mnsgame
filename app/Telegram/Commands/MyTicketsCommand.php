<?php
namespace App\Telegram\Commands;


use App\Models\TelegramTicket;
use App\Telegram\Enum\TelegramCommand;
use App\Telegram\Enum\TelegramMessage;
use App\Telegram\Service\TelegramChecker;

class MyTicketsCommand extends \Telegram\Bot\Commands\Command
{
    use TelegramChecker;

    protected $name = TelegramCommand::TICKETS;

    protected $description = TelegramCommand::TICKETS_DESCRIPTION;

    /**
     * @inheritDoc
     */
    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($updates->message->from);

        $tickets = TelegramTicket::where("user_id", $user_id)->get();

        if($tickets->isEmpty()){
            $this->replyWithMessage([
                "text" => TelegramMessage::EMPTY_TICKETS
            ]);
            return;
        }

        $text = TelegramMessage::TicketsList($tickets);

        $this->replyWithMessage([
            "text" => TelegramMessage::YOUR_TICKETS
        ]);

        $this->replyWithMessage([
            "text" => $text
        ]);
    }
}
