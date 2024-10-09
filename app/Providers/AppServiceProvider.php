<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PdsServiceInterface;
use App\Services\PdsService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind the interface to its implementation
        $this->app->bind(PdsServiceInterface::class, PdsService::class);
    }

    public function boot()
    {
        //
    }
}
