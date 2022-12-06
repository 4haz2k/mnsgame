<?php


namespace App\Telegram\Commands;


use App\Http\Interfaces\TelegramChecker;
use App\Models\TelegramTicket;
use App\Telegram\Enum\TelegramCommand;
use App\Telegram\Enum\TelegramMessage;
use App\Telegram\Enum\TelegramTicketStatus;
use Telegram\Bot\Objects\Update;

class CreateTicketCommand extends \Telegram\Bot\Commands\Command
{
    use TelegramChecker;

    protected $name = TelegramCommand::CREATE;

    protected $description = TelegramCommand::CREATE_DESCRIPTION;

    /**
     * @inheritDoc
     */
    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($updates->message->from);

        if($this->checkActiveTickets($user_id)){
            $this->replyWithMessage([
                'text' => TelegramMessage::ALREADY_CREATING,
                'parse_mode' => 'markdown'
            ]);
            return;
        }

        if($this->checkResolvingTickets($user_id)){
            $this->replyWithMessage([
                'text' => TelegramMessage::CANT_CREATE_TICKET_WHILE_TALKING,
                'parse_mode' => 'markdown'
            ]);
            return;
        }

        $this->createTicket($updates, $user_id);

        $this->replyWithMessage([
            'text' => TelegramMessage::ENTER_SUBJECT,
            'parse_mode' => 'markdown'
        ]);
    }

    private function createTicket(Update $updates, $user_id){
        $ticket = new TelegramTicket();

        $ticket->user_id = $user_id;
        $ticket->chat_id = $updates->message->chat->id;
        $ticket->step = TelegramTicketStatus::THEME;
        $ticket->is_creating = true;

        $ticket->save();
    }
}
