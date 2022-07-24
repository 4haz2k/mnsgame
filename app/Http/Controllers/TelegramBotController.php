<?php

namespace App\Http\Controllers;

use App\Console\Commands\Telegram\CreateTicketCommand;
use App\Console\Commands\Telegram\MyTicketsCommand;
use App\Console\Commands\Telegram\StartCommand;
use Telegram\Bot\Api;

class TelegramBotController extends Controller
{
    /**
     * @var Api $telegram
     */
    private Api $telegram;

    public function eventHandler(): string
    {
        $this->telegram = new Api(config("telegram.bots.mnsgame.token"));

        $this->registerComamands();

        $updates = $this->telegram->commandsHandler(true);

        if($updates->message->text == "Привет"){
            $this->telegram->sendMessage(['text' => "Ну здарова.", 'chat_id' => $updates->message->chat->id]);
        }

        return 'ok';
    }

    private function registerComamands(){
        $this->telegram->addCommands([
            StartCommand::class,
            CreateTicketCommand::class,
            MyTicketsCommand::class,
        ]);
    }
}
