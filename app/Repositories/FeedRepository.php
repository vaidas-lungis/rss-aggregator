<?php

namespace App\Repositories;


interface FeedRepository
{
    public function create(array $data): int;

    public function remove($id): bool;

    public function update($feedId, array $data);
}
