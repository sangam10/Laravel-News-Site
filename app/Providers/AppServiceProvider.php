<?php

namespace App\Providers;

use App\Interfaces\CategoryInterface;
use App\Interfaces\CategoryNewsInterface;
use App\Repositories\ImageRepository;
use App\Interfaces\ImageInterface;
use App\Interfaces\NewsInterface;
use App\Repositories\CategoryNewsRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\NewsRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImageInterface::class, ImageRepository::class);
        $this->app->bind(NewsInterface::class, NewsRepository::class);
        $this->app->bind(CategoryNewsInterface::class, CategoryNewsRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();  
    }
}
