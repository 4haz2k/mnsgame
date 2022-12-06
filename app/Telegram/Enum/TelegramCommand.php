<?php

namespace App\Telegram\Enum;

abstract class TelegramCommand
{
    // /tickets command
    const TICKETS = 'tickets';
    const TICKETS_DESCRIPTION = 'Список моих обращений';

    // /close_ticket command
    const CLOSE_ADMIN = 'close_ticket';
    const CLOSE_USER = 'close';
    const CLOSE_DESCRIPTION = 'Закрыть обращение';

    // /take command
    const TAKE = 'take';
    const TAKE_DESCRIPTION = 'Ответить на обращение';

    // /start command
    const START = 'start';
    const START_DESCRIPTION = 'Начало работы с ботом технической поддержки MNS Game Support';

    // /create command
    const CREATE = 'create';
    const CREATE_DESCRIPTION = 'Создать обращение в техническую поддержку';
}
