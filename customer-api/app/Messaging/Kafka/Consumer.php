<?php

namespace App\Messaging\Kafka;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use App\Messaging\Contracts\ConsumerInterface;

class Consumer implements ConsumerInterface
{
    /**
     * @param string $topic
     */
    public function getMessages(string $topic): array
    {
        $messages = [];
        $consumer = Kafka::createConsumer([$topic])
                        ->stopAfterLastMessage()
                        ->withHandler(function(KafkaConsumerMessage $kafkaConsumerMessage) use (&$messages) {
                            $messages[] = json_decode($kafkaConsumerMessage->getBody(), true);
                        })
                        ->build();

        $consumer->consume();

        return $messages;
    }
}
