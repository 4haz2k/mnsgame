<?php

namespace App\Console\Commands\App;

use App\Models\ServerOnline;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class RemoveOldOnlineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:removeOldOnline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old servers online';

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
     * @return int
     */
    public function handle(): int
    {
        ServerOnline::where('created_at', '<', Carbon::now()->subMonths(2))->delete();

        return Command::SUCCESS;
    }
}
