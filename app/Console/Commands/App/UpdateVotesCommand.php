<?php

namespace App\Console\Commands\App;

use App\Http\Services\ServersVote;
use Illuminate\Console\Command;

class UpdateVotesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:updateVotes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update server votes';

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
     * @param ServersVote $serversVote
     * @return int
     */
    public function handle(ServersVote $serversVote): int
    {
        $serversVote->updateVotes();
        return Command::SUCCESS;
    }
}
