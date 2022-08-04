<?php

namespace App\Http\Interfaces;


use App\Models\Notifications;
use App\Models\PaymentHistory;

trait NotificationSender
{
    public function sendNotification(int $user_id, $title, $body){
        $notify = new Notifications();
        $notify->title = $title;
        $notify->body = $body;
        $notify->user_id = $user_id;
        $notify->is_viewed = false;
        $notify->save();
    }

    public function sendFirstNotification(int $user_id, $login){
        $title = "Добро пожаловать на MNS Game Project!";
        $body = '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="../img/msngame_project.png" alt="" width="257" height="28"></p>
<p style="text-align: center;">Здравствуйте, <strong>'.$login.'</strong>! Добро пожаловать на <strong>MNS Game Project</strong></p>
<p>&nbsp;</p>
<h4><strong>Для Вас мы подготовили</strong> ссылки, которые помогут вам быстрее разобраться в нашем сервисе</h4>
<ol>
<li><a href="https://mnsgame.ru/games" target="_blank">Игры</a> - это страница, где располагаются все доступные игры с их проектами. Выбрав игру, вы сможете выбрать необходимые категории, которые будут соответствовать вашим запросам. Нажимая на конкретный проект, Вам откроется более подробная информация о нём.</li>
<li><a href="https://mnsgame.ru/promote" target="_blank">Продвижение</a> - на этой странице Вы можете заказать продвижение своего проекта, если являетесь владельцем!</li>
<li><a href="https://mnsgame.ru/support" target="_blank">Поддержка</a> - это страница для связи с нами! Вы можете посмотреть нашу FAQ страницу, либо, если не нашли ответа на свой вопрос, создать обращение в нашем Telegram боте.&nbsp;</li>
<li><a href="https://mnsgame.ru/home" target="_blank">Личный кабинет</a> - в нём отображается меню личного кабинета, где можно посмотреть свои проекты, добавить новый проект, просмотреть уведомления и историю платежей, а также изменить настройки профиля.</li>
</ol>
<p>&nbsp;</p>
<p><strong>В наших социальных сетях вы можете следить за новостями и нововведениями проекта</strong></p>
<ol>
<li><a href="https://vk.com/mnsgameru" target="_blank">MNS Game Вконтакте</a></li>
<li><a href="https://t.me/+negTqGAPrX1lNGMy" target="_blank">Telegram</a></li>
<li><a href="https://www.instagram.com/mns.game" target="_blank">Instagram</a></li>
</ol>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">Спасибо за выбор нашего сервиса! Ваша команда<strong> MNS Game Project</strong>!</p>
<p>&nbsp;</p>';
        $notify = new Notifications();
        $notify->title = $title;
        $notify->body = $body;
        $notify->user_id = $user_id;
        $notify->is_viewed = false;
        $notify->save();
    }

    public function sendPaymentNotification($user_id, PaymentHistory $payment, $server_title){
        $title = "Успешная оплата проекта";
        $body = '<p>Платеж проекта <strong>'.$server_title.'</strong> прошёл успешно,<strong> </strong>спасибо за покупку!</p>
<p><strong>Сумма платежа</strong>: '.$payment->balance_change.' руб</p>
<p><strong>Активен до</strong>: '.$payment->end_date.'&nbsp;</p>
<p><strong>Дата пополнения</strong>: '.$payment->created_at.'&nbsp;</p>
<hr>
<p>Если у Вас возникли вопросы или средства не были начисленны на проект, то просьба обратиться к нам через <a href="https://t.me/mnsgame_bot">нашего Telegram бота</a>.</p>
<p>Ваша команда MNS Game Project!</p>';
        $notify = new Notifications();
        $notify->title = $title;
        $notify->body = $body;
        $notify->user_id = $user_id;
        $notify->is_viewed = false;
        $notify->save();
    }
}
