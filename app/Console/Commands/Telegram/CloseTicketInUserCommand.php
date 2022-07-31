<?php


namespace App\Console\Commands\Telegram;


use App\Http\Interfaces\TelegramChecker;
use Telegram\Bot\Exceptions\TelegramSDKException;

class CloseTicketInUserCommand extends \Telegram\Bot\Commands\Command
{
    protected $name = "close";

    protected $description = "Закрыть обращение";

    use TelegramChecker;

    /**
     * @inheritDoc
     */
    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($updates->message->from);

        $chat_id = $this->closeTicketInUser($user_id);

        try {
            $this->telegram->sendMessage([
                "chat_id" => $chat_id,
                "text" => "*Пользователь закрыл обращение.*",
                "parse_mode" => 'markdown'
            ]);
            $this->replyWithMessage([
                "text" => "*Вы закрыли обращение! Спасибо, что пользуетесь MNS Game Project!*"
            ]);
        } catch (TelegramSDKException $e) {
        }
    }
}
