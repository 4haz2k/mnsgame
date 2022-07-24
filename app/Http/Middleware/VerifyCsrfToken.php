<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    public function handle($request, Closure $next)
    {
        if ($request->headers->get('referer') == url(config("telegram.bots.mnsgame.token")."/webhook")) {
            $this->except[] = config("telegram.bots.mnsgame.token")."/webhook";
        }

        return parent::handle($request, $next);
    }

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/payment/callback/yandex'
    ];
}
