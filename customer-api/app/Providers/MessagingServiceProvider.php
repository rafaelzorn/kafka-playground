<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Enqueue\RdKafka\RdKafkaConnectionFactory;
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
        $this->app->singleton(RdKafkaConnectionFactory::class, function() {
            return  new RdKafkaConnectionFactory([
                'global' => [
                    'group.id'             => uniqid('', true),
                    'metadata.broker.list' => config('messaging.metadata_broker_list'),
                    'enable.auto.commit'   => 'false',
                ],
                'topic' => [
                    'auto.offset.reset' => 'beginning',
                ],
            ]);
        });

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
