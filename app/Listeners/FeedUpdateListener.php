<?php

namespace App\Listeners;

use App\Events\FeedCreated;
use App\Jobs\FeedUpdateJob;

class FeedUpdateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle(FeedCreated $event)
    {
        $job = new FeedUpdateJob($event->feed);
        dispatch($job);
    }
}
