<?php

namespace App\Jobs;

use App\Feed;
use App\FeedItem;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class FeedUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $feed = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('Feed update job', ['feed_id' => $this->feed]);
        $rss = simplexml_load_file($this->feed->url);
        Log::debug('Feed update feed response', ['response' => $rss->asXML()]);

        foreach ($rss->channel->item as $item){
            $feedItem = FeedItem::updateOrCreate(
                [
                    'guid' => $item->guid,
                    'feed_id' => $this->feed->id,
                ],[
                'title' => $item->title,
                'link'  => $item->link,
                'description' => $item->description,
            ]);
            Log::debug('Feed update job received item', ['feed_item_id' => $feedItem->id, 'created' => $feedItem->wasRecentlyCreated]);
        }
        Log::info('Feed update job finished');
    }
}
