<?php

/**
 * Настройки Yandex Metrika
 */
return [
    'cache'         => 60,                                  // Время жизни кэша в минутах , с версии laravel 5.8 в секундах
    'counter_id'    => env("YANDEX_COUNTER_ID"),       // Id счетчика Яндекс метрики
    'token'         => env("YANDEX_TOKEN"),            // oauth token
];
