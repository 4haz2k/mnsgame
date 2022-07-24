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
        // Это отправит сообщение с использованием метода `sendMessage` за кулисами
        // идентификатор пользователя/чата, который запустил эту команду.
        // `replyWith<Message|Photo|Audio|Video|Voice|Document|Sticker|Location|ChatAction>()` все доступные методы динамически
        // обрабатывается, когда вы заменяете `send<Method>` на `replyWith` и используете те же параметры, за исключением того, что chat_id НЕ нужно включать в массив.
        $this->replyWithMessage(['text' => "Здравствуйте. Выберите команду для продолжения:"]);

        // Это обновит статус чата до ввода...
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        // Это подготовит список доступных команд и отправит их пользователю.
        // Сначала получаем массив всех зарегистрированных команд
        // Они будут в формате 'command-name' => 'Command Handler Class'.
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
