<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\TelegramChecker;
use App\Http\Interfaces\TelegramResolver;
use App\Telegram\Commands\CloseTicketCommand;
use App\Telegram\Commands\CloseTicketInUserCommand;
use App\Telegram\Commands\CreateTicketCommand;
use App\Telegram\Commands\MyTicketsCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Commands\TakeTicketCommand;
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

        // TODO: код настолько говно, что нужно привести его хотя бы к одному принципу программирования. При возникновении любой ошибки бот ляжет на лопатки и ошибку хрен найдешь в этом говне...

        if($this->checkIsUserSupporter($user_id)){
            if($ticket = $this->checkIsAdminTakedTicket($user_id)){
                if($update->message->text != "/close_ticket"){
                    $this->sendMessageToUser($ticket, $update, $this->telegram);
                }
                $this->registerAdminCommandsInTicket();
            }
            else{
                $this->registerAdminCommands();
            }
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
            $this->registerUserCommandsInTicket();
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
        ]);
    }

    /**
     *
     * Регистрация команд админа в тикете
     *
     * @throws TelegramSDKException
     */
    private function registerAdminCommandsInTicket(){
        $this->telegram->addCommands([
            CloseTicketCommand::class,
        ]);
    }

    /**
     *
     * Регистрация команд пользователя в тикете
     *
     * @throws TelegramSDKException
     */
    private function registerUserCommandsInTicket(){
        $this->telegram->addCommands([
            CloseTicketInUserCommand::class,
        ]);
    }
}
