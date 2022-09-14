<?php

namespace App\Services\ExternalConsultAddress;

use Illuminate\Support\Facades\Http;
use App\Exceptions\ExternalConsultAddress\ExternalConsultAddressException;
use App\Services\ExternalConsultAddress\Contracts\ExternalConsultAddressServiceInterface;
use App\Constants\HttpStatusConstant;

class ViaCepService implements ExternalConsultAddressServiceInterface
{
    /**
     * @param int $zipCode
     *
     * @return array
     */
    public function getFullAddress(int $zipCode): array
    {
        $endpoint = config('services.external_consult_address.endpoint');
        $response = Http::get("{$endpoint}{$zipCode}/json/");

        $hasError = isset($response->json()['erro']) && $response->json()['erro'];

        if (
            $response->serverError() ||
            $response->failed() ||
            $response->clientError() ||
            $hasError
        ) {
            throw new ExternalConsultAddressException(
                trans('messages.address_not_found_by_zip_code'),
                HttpStatusConstant::NOT_FOUND,
            );
        }

        return $response->json();
    }
}
