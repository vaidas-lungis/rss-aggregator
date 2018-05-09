<?php

namespace App\Console\Commands\Feed;

use App\Feed;
use App\Jobs\FeedUpdateJob;
use Illuminate\Console\Command;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        foreach (Feed::all() as $feed){
            $job = new FeedUpdateJob($feed);
            dispatch($job);
        }
        $this->line('Triggered all feed updates');
    }
}
