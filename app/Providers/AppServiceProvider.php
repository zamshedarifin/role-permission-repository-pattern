<?php

namespace App\Providers;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
