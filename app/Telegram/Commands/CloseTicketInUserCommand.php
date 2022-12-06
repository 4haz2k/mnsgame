<?php


namespace App\Telegram\Commands;


use App\Http\Interfaces\TelegramChecker;
use App\Telegram\Enum\TelegramCommand;
use App\Telegram\Enum\TelegramMessage;
use Telegram\Bot\Exceptions\TelegramSDKException;

class CloseTicketInUserCommand extends \Telegram\Bot\Commands\Command
{
    protected $name = TelegramCommand::CLOSE_USER;

    protected $description = TelegramCommand::CLOSE_DESCRIPTION;

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
                "text" => TelegramMessage::USER_CLOSED_TICKET,
                "parse_mode" => 'markdown'
            ]);
            $this->replyWithMessage([
                "text" => TelegramMessage::YOU_CLOSED_TICKET_USER,
                "parse_mode" => 'markdown'
            ]);
        } catch (TelegramSDKException $e) {}
    }
}
