<?php

namespace App\Messaging\Contracts;

interface ProducerInterface
{
    /**
     * @param string $topic
     * @param mixed $message
     *
     * @return void
     */
    public function sendMessage(string $topic, mixed $message): void;
}
