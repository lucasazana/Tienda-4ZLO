<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Producto;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('dashboard', function ($view) {
            $view->with('productos', Producto::all());
        });
    }
}
