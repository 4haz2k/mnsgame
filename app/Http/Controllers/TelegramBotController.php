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

        $updates = $telegram->getWebhookUpdate();

        if($updates->message == "Привет"){
            $telegram->sendMessage(['text' => "Ну здарова.", 'chat_id' => $updates->get('chat_id')]);
        }

        return 'ok';
    }
}
