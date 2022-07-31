<?php


namespace App\Console\Commands\Telegram;


use App\Http\Interfaces\TelegramChecker;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Exceptions\TelegramSDKException;

class CloseTicketCommand extends Command
{
    use TelegramChecker;

    protected $name = "close_ticket";

    protected $description = "Закрыть обращение";

    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($updates->message->from);

        $chat_id = $this->closeTicketInAdmin($user_id);

        try {
            $this->telegram->sendMessage([
                "chat_id" => $chat_id,
                "text" => "*Администратор закрыл ваше обращение. Спасибо, что пользуетесь MNS Game Project!*",
                "parse_mode" => 'markdown'
            ]);
            $this->replyWithMessage([
                "text" => "Вы закрыли обращение!"
            ]);
        } catch (TelegramSDKException $e) {
        }
    }
}
