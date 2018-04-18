<?php

namespace Leavingstone\MessagingApi\Providers;

use Illuminate\Support\ServiceProvider;
use Leavingstone\MessagingApi\Commands\PublishCommand;

class TestProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->publishes([
          __DIR__ . '/../controllers' => base_path('resources/views/vendor/courier')
      ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
