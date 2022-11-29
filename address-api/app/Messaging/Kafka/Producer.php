<?php

namespace App\Messaging\Kafka;

use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use App\Messaging\Contracts\ProducerInterface;

class Producer implements ProducerInterface
{
    /**
     * @param string $topic
     * @param mixed $message
     *
     * @return void
     */
    public function sendMessage(string $topic, mixed $message): void
    {
        $message = new Message(body: $message);

        Kafka::publishOn($topic)->withMessage($message)->send();
    }
}
