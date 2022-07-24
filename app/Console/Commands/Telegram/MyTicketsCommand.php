<?php
namespace App\Console\Commands\Telegram;


class MyTicketsCommand extends \Telegram\Bot\Commands\Command
{
    protected $name = "tickets";

    protected $description = "Список моих обращений";

    /**
     * @inheritDoc
     */
    public function handle()
    {

    }
}
