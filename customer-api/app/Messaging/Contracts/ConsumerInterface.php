<?php

namespace App\Messaging\Contracts;

interface ConsumerInterface
{
    /**
     * @param string $topic
     *
     * @return array
     */
    public function getMessages(string $topic): array;
}
