<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IBaseRepository;
use Illuminate\Support\ServiceProvider;

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
    }
}
