<?php

namespace App\Services\Address\Contracts;

interface AddressServiceInterface
{
    /**
     * @param int $zipCode
     *
     * @return array
     */
    public function getAddressByZipCode(int $zipCode): array;
}
