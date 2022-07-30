<?php

namespace App\Http\Controllers;

use App\Console\Commands\Telegram\CloseTicketCommand;
use App\Console\Commands\Telegram\CreateTicketCommand;
use App\Console\Commands\Telegram\MyTicketsCommand;
use App\Console\Commands\Telegram\StartCommand;
use App\Console\Commands\Telegram\TakeTicketCommand;
use App\Http\Interfaces\TelegramChecker;
use App\Http\Interfaces\TelegramResolver;
use Telegram\Bot\Answers\Answerable;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

class TelegramBotController extends Controller
{
    private TelegramResolver $resolver;

    public function __construct()
    {
        $this->resolver = new TelegramResolver();
    }

    use TelegramChecker;

    /**
     * @var Api $telegram
     */
    private Api $telegram;

    public function eventHandler(): string
    {
        $this->telegram = new Api(config("telegram.bots.mnsgame.token"));
        $update = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($update->message->from);

        $this->registerLog($user_id, $update);

        if($this->checkIsUserSupporter($user_id)){
            $this->registerAdminCommands();
        }
        elseif($this->checkActiveTickets($user_id)){
            if($response = $this->resolver->resolverHandler($user_id, $update, $this->telegram)){
                $this->registerDefaultCommands();
                $this->sendMessageToUser(null, $update, $this->telegram, true, $response);
                return 0;
            }
        }
        elseif ($this->checkResolvingTickets($user_id)){
            $this->resolver->resolverHandler($user_id, $update, $this->telegram);
        }
        else{
            $this->registerDefaultCommands();
        }

        $this->telegram->commandsHandler(true);

        return 'ok';
    }

    /**
     *
     * Регистрация команд пользователя
     *
     * @throws TelegramSDKException
     */
    private function registerDefaultCommands(){
        $this->telegram->addCommands([
            StartCommand::class,
            CreateTicketCommand::class,
            MyTicketsCommand::class,
        ]);
    }

    /**
     *
     * Регистрация команд админа
     *
     * @throws TelegramSDKException
     */
    private function registerAdminCommands(){
        $this->telegram->addCommands([
            TakeTicketCommand::class,
            CloseTicketCommand::class
        ]);
    }
}
