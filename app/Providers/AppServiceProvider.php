<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use App\Http\Repositories\FileRepository;
use App\Http\Repositories\FileRepositoryInterface;
use App\Http\Repositories\TaskRepository;
use App\Http\Repositories\TaskRepositoryInterface;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
