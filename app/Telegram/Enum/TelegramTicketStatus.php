<?php

namespace App\Telegram\Enum;

abstract class TelegramTicketStatus
{
    const BODY = 'body';
    const BODY_MESSAGE = 'ввод сообщения';

    const WAITING = 'waiting';
    const WAITING_MESSAGE = 'ожидание администратора';

    const CLOSED = 'closed';
    const CLOSED_MESSAGE = 'решено/закрыто';

    const THEME = 'theme';
    const THEME_MESSAGE = 'создание темы';

    const RESOLVING = 'resolving';
    const RESOLVING_MESSAGE = 'решение проблемы';

    const UNDEFINED_MESSAGE = 'неизвестно';
}
