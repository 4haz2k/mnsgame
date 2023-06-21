<?php

namespace App\Console\Commands\App;

use Illuminate\Support\Facades\Log;
use App\Models\{Server, User};
use App\Notifications\PromoNotification;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

use Throwable;

class PromoSenderCommand extends Command
{
    protected $signature = 'promo:send';

    private const SLEEP_TIME = 5;

    public function handle(): int
    {
        $users = $this->getUsers();

        if (empty($users)) {
            $this->warn('Список пользователей пуст!');
            return self::SUCCESS;
        }

        $this->info('Начало рассылки');
        $this->output->progressStart(count($users));

        foreach ($users as $user) {
            try {
                /** @var User $user */
                $user->notify(new PromoNotification(['https://vk.cc/coVSRk', $user->login]));
            } catch (Throwable $exception) {
                Log::error($exception);
            }

            $this->output->progressAdvance();
            sleep(self::SLEEP_TIME);
        }

        $this->output->progressFinish();
        $this->info('Рассылка завершена');
        return self::SUCCESS;
    }

    private function getUsers(): Collection
    {
        return User::whereIn('id', [1, 2])->get()->keyBy('email');

        $servers = Server::with('user')->get();

        $users = new Collection();

        foreach ($servers as $server)
            $users->push($server->user);

        return $users->keyBy('email');
    }
}
