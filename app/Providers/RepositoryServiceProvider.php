<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IBaseRepository;
use Illuminate\Support\ServiceProvider;
use Module\Card\Repositories\CardRepository;
use Module\Card\Repositories\Contracts\ICardRepository;
use Module\User\Repositories\UserRepository;
use Module\User\Repositories\Contracts\IUserRepository;

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

        $this->app->bind(
            ICardRepository::class,
            CardRepository::class
        );
    }
}
