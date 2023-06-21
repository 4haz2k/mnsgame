<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PromoNotification extends Notification
{
    use Queueable;

    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        [$link, $login] = $this->params;

        return (new MailMessage())
            ->view('vendor.maileclipse.templates.promo', compact("link", "login"))
            ->subject("Конкурс 12-ти пакетов на MNS Game Мониторинг!");
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
