<?php

namespace App\Telegram\Enum;

abstract class TelegramMessage
{
    // Neutral messages
    const YOUR_TICKETS = 'Ваши обращения:';
    const TICKET_CLAIMED_BY_ADMIN = '*Ваше обращение принял администратор.* \nДля закрытия обращения напишите команду /close';
    const YOU_CLAIMED_TICKET = 'Обработка обращения принята! Перейдите в бота @mnsgame_bot для общения с пользователем.';
    const ENTER_SUBJECT = '*Введите тему обращения*';
    const USER_CLOSED_TICKET = '*Пользователь закрыл обращение.*';
    const YOU_CLOSED_TICKET_USER = '*Вы закрыли обращение! Спасибо, что пользуетесь MNS Game Мониторинг!*';
    const YOU_CLOSED_TICKET_ADMIN = '*Вы закрыли обращение!*';
    const ADMIN_CLOSED_TICKET = '*Администратор закрыл ваше обращение. Спасибо, что пользуетесь MNS Game Мониторинг!*';

    // Error messages
    const EMPTY_TICKETS = 'Список ваших обращений пуст! Для создания обращения используйте команду /create';
    const WRONG_TAKE_COMMAND = 'Необходимо ввести пользователя и ID обращения в формате /take @user 12345';
    const ALREADY_ANSWERED = 'Вы уже отвечаете на обращение!';
    const ALREADY_CREATING = '*Вы уже создаёте обращение!*';
    const CANT_CREATE_TICKET_WHILE_TALKING = '*Во время общения с технической поддержкой запрещено использовать команды!*';

    /**
     * Обращение с ID %s не найдено!
     *
     * @example "Обращение с ID 2 не найдено!"
     *
     * @param $ID
     * @return string
     */
    public static function TicketNotFound($ID): string
    {
        return sprintf('Обращение с ID %s не найдено!', $ID);
    }

    /**
     * Здравствуйте, *%s*. Выберите команду для продолжения:
     *
     * @example "Здравствуйте, *alekse12k*. Выберите команду для продолжения:"
     *
     * @param $name
     * @return string
     */
    public static function Greeting($name): string
    {
        return sprintf('Здравствуйте, *%s*. Выберите команду для продолжения:', $name);
    }

    /**
     * Returning commands with format /%s - %s
     *
     * @example "/start - Начало"
     *
     * @param $commands
     * @return string
     */
    public static function AvailableCommands($commands): string
    {
        $response = '';

        foreach ($commands as $name => $command)
            $response .= sprintf("/%s - %s\n", $name, $command->getDescription());

        return $response;
    }

    /**
     * Returning ticket by format "Тема обращения: %s\nДата создания: %s\nСтатус: %s\n\n"
     *
     * @example Тема обращения: Проблема регистрации
     * @example Дата создания: 06.12.2022 11:53:10
     * @example Статус: ожидание администратора
     *
     * @param $tickets
     * @return string
     */
    public static function TicketsList($tickets): string
    {
        $text = '';

        foreach ($tickets as $ticket) {
            switch ($ticket->step)
            {
                case TelegramTicketStatus::WAITING:
                    $status = TelegramTicketStatus::WAITING_MESSAGE;
                    break;
                case TelegramTicketStatus::CLOSED:
                    $status = TelegramTicketStatus::CLOSED_MESSAGE;
                    break;
                default:
                    $status = TelegramTicketStatus::UNDEFINED_MESSAGE;
                    break;
            }
            $text .= sprintf(
                "Тема обращения: %s\nДата создания: %s\nСтатус: %s\n\n",
                $ticket->theme, $ticket->created_at->format('d.m.Y H:i:s'), $status
            );
        }

        return $text;
    }
}
