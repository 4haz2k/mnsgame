<?php


namespace App\Console\Commands\Telegram;


use App\Http\Interfaces\TelegramChecker;
use App\Models\TelegramTicket;
use App\Models\TelegramUser;
use Telegram\Bot\Objects\Update;

class CreateTicketCommand extends \Telegram\Bot\Commands\Command
{
    use TelegramChecker;

    protected $name = "create";

    protected $description = "Создать обращение в техническую поддержку";

    /**
     * @inheritDoc
     */
    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($updates->message->from);

        if($this->checkActiveTickets($user_id)){
            $this->replyWithMessage([
                'text' => "*Вы уже создаёте обращение!*",
                'parse_mode' => 'markdown'
            ]);
            return;
        }

        if($this->checkResolvingTickets($user_id)){
            $this->replyWithMessage([
                'text' => "*Во время общения с технической поддержкой запрещено использовать команды!*",
                'parse_mode' => 'markdown'
            ]);
            return;
        }

        $this->createTicket($updates, $user_id);

        $this->replyWithMessage([
            'text' => "*Введите тему обращения*",
            'parse_mode' => 'markdown'
        ]);
    }

    private function createTicket(Update $updates, $user_id){
        $ticket = new TelegramTicket();

        $ticket->user_id = $user_id;
        $ticket->chat_id = $updates->message->chat->id;
        $ticket->step = "theme";
        $ticket->is_creating = true;

        $ticket->save();
    }
}
