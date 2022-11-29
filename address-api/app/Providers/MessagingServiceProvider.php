<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Messaging\Contracts\ProducerInterface;
use App\Messaging\Kafka\Producer;

class MessagingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProducerInterface::class, Producer::class);
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
