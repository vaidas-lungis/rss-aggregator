<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    public function feedItems()
    {
        return $this->hasMany(FeedItem::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'feed_category');
    }
}
