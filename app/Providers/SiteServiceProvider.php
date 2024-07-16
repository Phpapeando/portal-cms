<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class SiteServiceProvider extends ServiceProvider
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
        View::composer('*', function ($view) {

            if(Auth::check()){
                $user = Auth::user();
                $projetos = $user->sites;
    
                $view->with('projetos', $projetos);
            }
        });
    }
}
