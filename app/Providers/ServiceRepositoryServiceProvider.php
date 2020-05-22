<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        providerRegister('app/Repositories', 'App\Repositories', $this->app);
        providerRegister('app/Services', 'App\Services', $this->app);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
