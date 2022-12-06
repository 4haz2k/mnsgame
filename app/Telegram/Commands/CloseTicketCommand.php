<?php


namespace App\Telegram\Commands;


use App\Telegram\Enum\TelegramCommand;
use App\Telegram\Enum\TelegramMessage;
use App\Telegram\Service\TelegramChecker;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Exceptions\TelegramSDKException;

class CloseTicketCommand extends Command
{
    use TelegramChecker;

    protected $name = TelegramCommand::CLOSE_ADMIN;

    protected $description = TelegramCommand::CLOSE_DESCRIPTION;

    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($updates->message->from);

        $chat_id = $this->closeTicketInAdmin($user_id);

        try {
            $this->telegram->sendMessage([
                "chat_id" => $chat_id,
                "text" => TelegramMessage::ADMIN_CLOSED_TICKET,
                "parse_mode" => 'markdown'
            ]);
            $this->replyWithMessage([
                "text" => TelegramMessage::YOU_CLOSED_TICKET_ADMIN
            ]);
        } catch (TelegramSDKException $e) {}
    }
}
