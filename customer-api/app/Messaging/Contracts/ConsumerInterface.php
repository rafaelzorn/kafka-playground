<?php

namespace App\Messaging\Contracts;

interface ConsumerInterface
{
    /**
     * @param string $topic
     *
     * @return array
     */
    public function getMessage(string $topic): array;
}
