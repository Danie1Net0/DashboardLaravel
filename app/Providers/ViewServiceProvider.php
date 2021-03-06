<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ViewServiceProvider
 * @package App\Providers
 */
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.dashboard.parts.sidebar', function ($view) {
            $user = Auth::user();
            return $view->with([
                'sidebarItems' => config('sidebar'),
                'avatar' => url(Storage::url($user->avatar)),
                'userName' => $user->firstName
            ]);
        });

        View::composer('layouts.dashboard.parts.nav', function ($view) {
            $usuario = Auth::user();
            return $view->with('userName', $usuario->firstName);
        });

        Blade::include('layouts.forms.fields.form-input', 'input');
        Blade::include('layouts.forms.fields.form-input-file', 'inputFile');
        Blade::include('layouts.forms.fields.form-textarea', 'textarea');
        Blade::include('layouts.forms.fields.form-select', 'select');
        Blade::include('layouts.forms.fields.form-checkbox', 'checkbox');
        Blade::include('layouts.forms.fields.form-error', 'formError');
        Blade::include('layouts.forms.buttons.form-button', 'button');
    }
}
