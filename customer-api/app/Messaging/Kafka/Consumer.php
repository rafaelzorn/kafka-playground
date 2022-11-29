<?php

namespace App\Messaging\Kafka;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use App\Messaging\Contracts\ConsumerInterface;

class Consumer implements ConsumerInterface
{
    /**
     * @param string $topic
     *
     * @return array
     */
    public function getMessage(string $topic): array
    {
        $consumer = Kafka::createConsumer([$topic])
                        ->withHandler(function(KafkaConsumerMessage $kafkaConsumerMessage) {

                        })
                        ->build();

        $consumer->consume();
    }
}
