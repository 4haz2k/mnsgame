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

        $this->init();
    }

    public function eventHandler(): ?string
    {
        // Определяем чью роль будем обрабатывать
        switch ($this->checkIsUserSupporter($this->user_id)) {
            case TelegramRoles::ADMIN: // Админ
                $this->resolver->adminHandler();
                break;
            case TelegramRoles::USER: // Пользователь
                $this->resolver->userHandler();
                break;
        }

        $this->telegram->commandsHandler(true);

        return 'ok';
    }

    private function init()
    {
        // Регистрация пользователя
        $this->registerUser($this->updates->message->from);

        // Пишем логи
        $this->registerLog();
    }
}
