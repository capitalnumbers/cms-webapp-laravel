<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Main;
use App\Repositories\UserRepository;
use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;

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
        $this->app->singleton(Main::class, UserRepository::class, PostCategoryRepository::class, PostRepository::class);
    }
}
