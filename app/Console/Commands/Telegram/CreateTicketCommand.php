<?php


namespace App\Console\Commands\Telegram;


class CreateTicketCommand extends \Telegram\Bot\Commands\Command
{
    protected $name = "create";

    protected $description = "Создать обращение в техническую поддержку";

    /**
     * @inheritDoc
     */
    public function handle()
    {

    }
}
