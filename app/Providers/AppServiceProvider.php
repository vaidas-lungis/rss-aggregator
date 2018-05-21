<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Elequent\CategoryElequentRepository;
use App\Repositories\Elequent\FeedCategoryElequentRepository;
use App\Repositories\Elequent\FeedElequentRepository;
use App\Repositories\FeedCategoryRepository;
use App\Repositories\FeedRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, CategoryElequentRepository::class);
        $this->app->bind(FeedRepository::class, FeedElequentRepository::class);
        $this->app->bind(FeedCategoryRepository::class, FeedCategoryElequentRepository::class);

    }
}
