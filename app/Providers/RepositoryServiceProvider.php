<?php

namespace App\Providers;

use App\Contracts\TaskRepository;
use App\Contracts\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, \App\Repositories\UserRepository::class);
        $this->app->bind(TaskRepository::class, \App\Repositories\TaskRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
