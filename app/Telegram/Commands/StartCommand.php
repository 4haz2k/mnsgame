<?php

namespace App\Telegram\Commands;

use App\Telegram\Enum\TelegramCommand;
use App\Telegram\Enum\TelegramMessage;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected $name = TelegramCommand::START;

    protected $description = TelegramCommand::START_DESCRIPTION;

    /**
     * @inheritDoc
     */
    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $this->replyWithMessage([
            'text' => TelegramMessage::Greeting($updates->message->from->firstName),
            'parse_mode' => 'markdown'
        ]);

        $this->replyWithChatAction(['action' => Actions::TYPING]);

        // Creating list
        $response = TelegramMessage::AvailableCommands($this->getTelegram()->getCommands());

        // Reply with list
        $this->replyWithMessage(['text' => $response]);
    }
}
