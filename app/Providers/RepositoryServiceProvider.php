<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IBaseRepository;
use Illuminate\Support\ServiceProvider;
use Module\User\Repositories\Contracts\IUserRepository;
use Module\User\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            IBaseRepository::class,
            BaseRepository::class
        );

        $this->app->bind(
            IUserRepository::class,
            UserRepository::class
        );
    }
}
