<?php

namespace App\Services\ExternalConsultAddress\Contracts;

interface ExternalConsultAddressServiceInterface
{
    /**
     * @param int $zipCode
     *
     * @return array
     */
    public function getAddressByZipCode(int $zipCode): array;
}
