<?php

namespace App\Console\Commands;

use App\Http\Services\ServerOnline;
use Illuminate\Console\Command;

class UpdateOnlineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:updateOnline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Servers Online';

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
     * @param ServerOnline $serverOnline
     * @return int
     */
    public function handle(ServerOnline $serverOnline): int
    {
        $serverOnline->updateOnline();
        return Command::SUCCESS;
    }
}
