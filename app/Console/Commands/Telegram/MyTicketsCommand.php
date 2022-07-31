<?php
namespace App\Console\Commands\Telegram;


use App\Http\Interfaces\TelegramChecker;
use App\Models\TelegramTicket;
use Carbon\Carbon;

class MyTicketsCommand extends \Telegram\Bot\Commands\Command
{
    use TelegramChecker;

    protected $name = "tickets";

    protected $description = "Список моих обращений";

    /**
     * @inheritDoc
     */
    public function handle()
    {
        $updates = $this->telegram->getWebhookUpdate();

        $user_id = $this->registerUser($updates->message->from);

        $tickets = TelegramTicket::where("user_id", $user_id)->get();

        if($tickets->isEmpty()){
            $this->replyWithMessage([
                "text" => "Список ваших обращений пуст! Для создания обращения используйте команду /create"
            ]);
            return;
        }

        $text = "";

        foreach ($tickets as $ticket) {
            switch ($ticket->step){
                case "waiting":
                    $status = "ожидание администратора";
                    break;
                case "closed":
                    $status = "решено/закрыто";
                    break;
                default:
                    $status = "неизвестно";
                    break;
            }
            $text .= "Тема обращения: $ticket->theme\nДата создания: ".$ticket->created_at->format('d.m.Y H:i:s')."\nСтатус: $status\n\n";
        }

        $this->replyWithMessage([
            "text" => "Ваши обращения:"
        ]);

        $this->replyWithMessage([
            "text" => $text
        ]);
    }
}
