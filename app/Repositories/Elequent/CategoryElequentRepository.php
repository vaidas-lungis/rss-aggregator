<?php

namespace App\Repositories\Elequent;

use App\Category;
use App\Repositories\CategoryRepository;

class CategoryElequentRepository implements CategoryRepository
{

    public function create(array $data): int
    {
        $model       = app(Category::class);
        $model->name = ucfirst($data['name']);
        $model->save();
        return $model->id;
    }

}