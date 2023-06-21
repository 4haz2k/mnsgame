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
    protected $signature = 'promo:send
                            {link : link of promo}';

    protected $description = 'Promo notifications';

    private const SLEEP_TIME = 5;

    public function handle(): int
    {
        $link = $this->argument('link');

        if (! $link) {
            $this->error('Link needed');
            return self::FAILURE;
        }

        $users = $this->getUsers();

        if (empty($users)) {
            $this->warn('Users list is empty!');
            return self::SUCCESS;
        }

        $this->info('Starting promo send');
        $this->output->progressStart(count($users));

        foreach ($users as $user) {
            try {
                /** @var User $user */
                $user->notify(new PromoNotification([$link, $user->login]));
            } catch (Throwable $exception) {
                Log::error($exception);
            }

            $this->output->progressAdvance();
            sleep(self::SLEEP_TIME);
        }

        $this->output->progressFinish();
        $this->info('Promo send finished');
        return self::SUCCESS;
    }

    private function getUsers(): Collection
    {
        $servers = Server::with('user')->get();

        $users = new Collection();

        foreach ($servers as $server)
            $users->push($server->user);

        return $users->keyBy('email');
    }
}
