<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FormBuilder;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FormBuilder::boot();
        View::share( 'BASE_URL_API', 'http://10.0.2.2:53149' );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Appzcoder\CrudGenerator\CrudGeneratorServiceProvider');
        }
    }
}