<?php

namespace App\Services\ExternalConsultAddress\Contracts;

interface ExternalConsultAddressServiceInterface
{
    /**
     * @param int $zipCode
     *
     * @return array
     */
    public function getFullAddress(int $zipCode): array;
}
