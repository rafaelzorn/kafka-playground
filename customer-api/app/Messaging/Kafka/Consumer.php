<?php

namespace App\Messaging\Kafka;

use Enqueue\RdKafka\RdKafkaConnectionFactory;
use App\Messaging\Contracts\ConsumerInterface;
use App\Exceptions\Consumer\ConsumerException;

class Consumer implements ConsumerInterface
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
     *
     * @return array
     */
    public function getMessage(string $topic): array
    {
        $context  = $this->rdKafkaConnection->createContext();
        $queue    = $context->createQueue($topic);
        $consumer = $context->createConsumer($queue);
        $message  = $consumer->receive();

        if ($message->getKafkaMessage()->err !== 0) {
            throw new ConsumerException(
                trans('messages.error_consuming_kafka_message')
            );
        }

        $consumer->acknowledge($message);

        return json_decode($message->getBody(), true);
    }
}
