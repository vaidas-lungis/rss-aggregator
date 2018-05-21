<?php

namespace App\Repositories\Elequent;

use App\Feed;
use App\Repositories\FeedCategoryRepository;
use Illuminate\Support\Facades\DB;

class FeedCategoryElequentRepository implements FeedCategoryRepository
{
    public function reset($feedId): bool
    {
        return DB::table('feed_category')->where('feed_id', $feedId)->delete();
    }

    public function create($feedId, array $categories): int
    {
        $updated = 0;
        $feed    = Feed::find($feedId);
        foreach ($categories as $categoryId => $state) {
            if ($state === 'on') {
                $feed->categories()->attach($categoryId);
                $updated++;
            }
        }
        return $updated;

    }

}
