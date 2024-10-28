<?php

namespace App\Providers;

use App\Exceptions\CustomExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExceptionHandler::class, CustomExceptionHandler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
