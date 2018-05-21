<?php

namespace App\Repositories\Elequent;

use App\Feed;
use App\Repositories\FeedRepository;

class FeedElequentRepository implements FeedRepository
{

    public function create(array $data): int
    {
        $model      = app(Feed::class);
        $model->url = $data['url'];
        $model->save();
        return $model->id;
    }

    public function remove($id): bool
    {
        return Feed::destroy($id) > 0;
    }

    public function update($feedId, array $data)
    {

        return Feed::where('id', $feedId)->update([
            'url' => $data['url'],
        ]);
    }

}
