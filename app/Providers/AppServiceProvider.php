<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Elequent\CategoryElequentRepository;
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

    }
}
