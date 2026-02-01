<?php

namespace App\Providers;

use App\Models\ProfilDesa;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share profil desa ke semua view
        View::composer('*', function ($view) {
            $profil = ProfilDesa::first();
            $view->with('profil', $profil);
        });
    }
}
