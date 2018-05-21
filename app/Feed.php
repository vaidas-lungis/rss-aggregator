<?php

namespace App;

use App\Events\FeedCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feed extends Model
{
    use Notifiable;

    public function feedItems()
    {
        return $this->hasMany(FeedItem::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'feed_category');
    }

    protected $dispatchesEvents = [
        'created' => FeedCreated::class,
    ];
}
