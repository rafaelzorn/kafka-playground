<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Messaging\Contracts\ConsumerInterface;
use App\Messaging\Kafka\Consumer;

class MessagingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConsumerInterface::class, Consumer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
