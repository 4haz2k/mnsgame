<?php

namespace App\Http\Controllers;

use App\Telegram\Commands\CloseTicketInUserCommand;
use App\Telegram\Commands\CreateTicketCommand;
use App\Telegram\Commands\MyTicketsCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Enum\TelegramRoles;
use App\Telegram\Service\TelegramChecker;
use App\Telegram\Service\TelegramResolver;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\Update;

class TelegramBotController extends Controller
{
    use TelegramChecker;

    private TelegramResolver $resolver;
    private Api $telegram;
    private Update $updates;
    private int $user_id;

    public function __construct()
    {
        $this->telegram = new Api(config("telegram.bots.mnsgame.token"));
        $this->updates = $this->telegram->getWebhookUpdate();
        $this->user_id = $this->registerUser($this->updates->message->from);

        $this->resolver = new TelegramResolver($this->telegram, $this->updates, $this->user_id);
    }

    public function eventHandler(): ?string
    {
        // Регистрация пользователя
        $user_id = $this->registerUser($this->updates->message->from);

        // Пишем логи
        $this->registerLog($user_id, $this->updates);

        // Определяем чью роль будем обрабатывать
        switch ($this->checkIsUserSupporter($this->user_id)) {
            case TelegramRoles::ADMIN: // Админ
                $this->resolver->adminHandler();
                break;
            case TelegramRoles::USER: // Пользователь
                TelegramResolver::userHandler();
                break;
        }

        $this->telegram->commandsHandler(true);

        return 'ok';
    }

    /**
     * Регистрация команд пользователя
     */
    private function registerDefaultCommands(){
        try {
            $this->telegram->addCommands([
                StartCommand::class,
                CreateTicketCommand::class,
                MyTicketsCommand::class,
            ]);
        } catch (TelegramSDKException $exception) {}
    }

    /**
     * Регистрация команд пользователя в тикете
     */
    private function registerUserCommandsInTicket(){
        try {
            $this->telegram->addCommands([
                CloseTicketInUserCommand::class,
            ]);
        } catch (TelegramSDKException $exception) {}
    }
}
