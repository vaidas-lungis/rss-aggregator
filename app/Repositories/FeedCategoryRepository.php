<?php

namespace App\Repositories;


interface FeedCategoryRepository
{
    public function reset($feedId): bool;

    public function create($feedId, array $categories): int;
}
