<?php

namespace App\Providers;

use App\Repositories\FriendRepository;
use App\Repositories\Interfaces\FriendRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class FriendServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FriendRepositoryInterface::class, FriendRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
