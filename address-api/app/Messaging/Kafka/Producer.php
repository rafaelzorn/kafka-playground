<?php

namespace App\Messaging\Kafka;

use Enqueue\RdKafka\RdKafkaConnectionFactory;
use App\Messaging\Contracts\ProducerInterface;

class Producer implements ProducerInterface
{
    /**
     * @param RdKafkaConnectionFactory $rdKafkaConnection
     *
     */
    public function __construct(private RdKafkaConnectionFactory $rdKafkaConnection)
    {
        $this->rdKafkaConnection = $rdKafkaConnection;
    }

    /**
     * @param string $topic
     * @param mixed $message
     *
     * @return void
     */
    public function sendMessage(string $topic, mixed $message): void
    {
        $context = $this->rdKafkaConnection->createContext();

        $message = $context->createMessage($message);
        $topic   = $context->createQueue($topic);

        $context->createProducer()->send($topic, $message);
    }
}
