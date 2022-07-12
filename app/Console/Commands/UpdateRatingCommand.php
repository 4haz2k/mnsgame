<?php

namespace App\Console\Commands;

use App\Http\Services\ServersRating;
use Illuminate\Console\Command;

class UpdateRatingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:updateRating';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update servers rating';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ServersRating $serversRating
     * @return int
     */
    public function handle(ServersRating $serversRating): int
    {
        $serversRating->updateRating();
        return Command::SUCCESS;
    }
}
