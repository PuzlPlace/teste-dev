<?php

namespace App\Providers;

use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\BookManagerInterface;
use App\Services\Contracts\UserManagerInterface;
use App\Services\JWTAuthService;
use App\Services\BookManagerService;
use App\Services\UserManagerService;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserManagerInterface::class, UserManagerService::class);
        $this->app->bind(BookManagerInterface::class, BookManagerService::class);
        $this->app->bind(\App\Services\Contracts\JWTAuthService::class, JWTAuthService::class);
    }
}
