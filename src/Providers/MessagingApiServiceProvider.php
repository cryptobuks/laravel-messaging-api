<?php

namespace Leavingstone\MessagingApi\Providers;

use Illuminate\Support\ServiceProvider;
use Leavingstone\MessagingApi\Commands\CreateServiceCommand;
use Leavingstone\MessagingApi\Commands\PublishCommand;

class MessagingApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->commands([
            PublishCommand::class,
            CreateServiceCommand::class
        ]);
        $this->publishes([
            __DIR__ . '/../Http/Controllers' => app_path('Http/Controllers/Messaging')
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
