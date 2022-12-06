<?php
namespace App\Telegram\Service;

use App\Models\TelegramTicket;
use App\Telegram\Commands\CloseTicketCommand;
use App\Telegram\Commands\CloseTicketInUserCommand;
use App\Telegram\Commands\CreateTicketCommand;
use App\Telegram\Commands\MyTicketsCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Commands\TakeTicketCommand;
use App\Telegram\Enum\TelegramCommand;
use App\Telegram\Enum\TelegramMessage;
use App\Telegram\Enum\TelegramTicketStatus;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\Update;

class TelegramResolver
{
    use TelegramChecker;

    private Api $telegram;
    private Update $updates;
    private string $command;
    private int $user_id;

    public function __construct(Api $telegram, Update $updates, int $user_id)
    {
        $this->telegram = $telegram;
        $this->updates = $updates;
        $this->user_id = $user_id;

        $this->command = @explode(' ', @explode('/', $updates->message->text)[1])[0];
    }

    /**
     *
     * Обработка типов обращений
     *
     * @param $user_id
     * @param Update $updates
     * @param $telegram
     * @return bool
     */
    public function resolverHandler($user_id, Update $updates, $telegram): bool
    {
        $ticket = $this->getTicket($user_id);

        switch ($ticket->step){
            case TelegramTicketStatus::THEME:
                $this->saveTheme($ticket, $updates->message->text);
                $this->registerUserCommands();
                $this->sendMessageToUser(null, $this->updates, $this->telegram, true, TelegramMessage::ENTER_BODY);
                break;

            case TelegramTicketStatus::BODY:
                $this->saveBody($ticket, $updates->message->text);
                $this->sendToSupport($telegram, $updates, $ticket->id);
                $this->registerUserCommands();
                $this->sendMessageToUser(null, $this->updates, $this->telegram, true, TelegramMessage::TicketCreated());
                break;

            case TelegramTicketStatus::RESOLVING:
                if($this->command == TelegramCommand::CLOSE_USER) {
                    $this->registerUserCommands(true);
                    return false;
                }

                $this->sendMessageToAdmin($ticket, $updates, $telegram);
                break;

            default:
                $this->registerUserCommands();
                return false;
        }

        return true;
    }

    /**
     *
     * Обработчик действий админа
     *
     * @return void
     */
    public function adminHandler()
    {
        $ticket = TelegramChecker::checkIsAdminTookTicket($this->user_id);

        if ($this->command != TelegramCommand::CLOSE_ADMIN) { // проверяем, ввёл ли админ команду закрытия тикета
            $this->sendMessageToUser($ticket, $this->updates, $this->telegram); // если не ввёл, то отправляем сообщение админа пользователю
        }

        $this->registerAdminCommands($ticket);
    }

    /**
     *
     * Обработчик действий пользователя
     *
     * @return void|null
     */
    public function userHandler()
    {
        if (TelegramChecker::checkActiveTickets($this->user_id))
        {
            $response = $this->resolverHandler($this->user_id, $this->updates, $this->telegram);

            if($response)
                return;
        }

        $this->registerUserCommands();
    }

    /**
     *
     * Регистрация команд пользователя
     *
     * @param bool $isInTicket
     * @return void
     */
    private function registerUserCommands(bool $isInTicket = false){
        if($isInTicket)
            $commands = [
                CloseTicketInUserCommand::class
            ];
        else
            $commands = [
                StartCommand::class,
                CreateTicketCommand::class,
                MyTicketsCommand::class,
            ];

        try {
            $this->telegram->addCommands($commands);
        } catch (TelegramSDKException $exception) {}
    }

    /**
     * Регистрация команд админа
     *
     * @param $isInTicket
     * @return void
     */
    public function registerAdminCommands($isInTicket)
    {
        try {
            $this->telegram->addCommands([
                $isInTicket ? CloseTicketCommand::class : TakeTicketCommand::class,
            ]);
        } catch (TelegramSDKException $exception) {}
    }

    /**
     *
     * Получение тикета текущего сообщения
     *
     * @param $user_id
     * @return mixed
     */
    private function getTicket($user_id)
    {
       return
           TelegramTicket::where("user_id", $user_id)
               ->where("step", "!=", TelegramTicketStatus::CLOSED)
               ->where("step", "!=", TelegramTicketStatus::WAITING)
               ->first();
    }

    /**
     *
     * Сохранение темы тикета
     *
     * @param TelegramTicket $ticket
     * @param string $message
     * @return void
     */
    private function saveTheme(TelegramTicket $ticket, string $message)
    {
        $ticket->theme = $message;
        $ticket->step = TelegramTicketStatus::BODY;
        $ticket->save();
    }

    /**
     *
     * Сохранение сообщения тикета
     *
     * @param TelegramTicket $ticket
     * @param string $message
     * @return void
     */
    private function saveBody(TelegramTicket $ticket, string $message){
        $ticket->body = $message;
        $ticket->step = TelegramTicketStatus::WAITING;
        $ticket->is_creating = false;
        $ticket->save();
    }
}
