<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram\Bot\Traits\Telegram;

class TelegramBotController extends Controller
{
    public function eventHandler(): string
    {
        $telegram = new Api(config("telegram.bots.mnsgame.token"));

        $updates = $telegram->commandsHandler(true);

        if($updates->message->text == "Привет"){
            $telegram->sendMessage(['text' => "Ну здарова.", 'chat_id' => $updates->message->chat->id]);
        }

        return 'ok';
    }
}
