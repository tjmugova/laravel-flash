<?php

namespace Tjmugova\LaravelFlash;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LaravelFlashServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function register()
    {
        $this->app->bind(
            'Tjmugova\LaravelFlash\SessionStore',
            'Tjmugova\LaravelFlash\LaravelSessionStore'
        );

        $this->app->singleton('flash', function () {
            return $this->app->make('Tjmugova\LaravelFlash\FlashNotifier');
        });
        $this->mergeConfigFrom(
            __DIR__ . '/../config/flash.php',
            'flash'
        );
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'flash');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/flash')
        ], 'flash-views');
        $this->publishes([
            __DIR__ . '/../config/flash.php' => config_path('flash.php'),
        ], 'flash-config');
        Blade::component('flash::message', 'flash');
        Blade::component('flash::validation', 'flash-validation');
        if (class_exists(Livewire::class)) {
            Livewire::component('flash-message', \Tjmugova\LaravelFlash\Livewire\FlashMessage::class);
            //Livewire::component('flash-container', \Tjmugova\LaravelFlash\Livewire\FlashContainer::class);
        }
    }
}