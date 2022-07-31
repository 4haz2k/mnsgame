<?php

namespace App\Console\Commands\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected $name = "start";

    protected $description = "Начало работы с ботом технической поддержки MNS Game Support";

    /**
     * @inheritDoc
     */
    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();
        $this->replyWithMessage([
            'text' => "Здравствуйте, *{$updates->message->from->firstName}*. Выберите команду для продолжения:",
            'parse_mode' => 'markdown'
        ]);

        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $commands = $this->getTelegram()->getCommands();

        // Создание списка
        $response = '';
        foreach ($commands as $name => $command) {
            /** @var Command $command */
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }

        // Ответ со списком команд
        $this->replyWithMessage(['text' => $response]);

        // Динамически запустить другую команду из этой команды
        // Если вы хотите объединить несколько команд в одну или обработать запрос дальше.
        // Метод поддерживает аргументы второго параметра, которые вы можете передать по желанию. По умолчанию
        // будут переданы те же аргументы, что и исходно полученные для этой команды.
        $this->triggerCommand('subscribe');
    }
}
