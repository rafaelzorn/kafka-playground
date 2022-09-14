<?php

namespace App\Services\Address;

use Exception;
use App\Http\Resources\Address\AddressResource;
use App\Exceptions\ExternalConsultAddress\ExternalConsultAddressException;
use App\Services\Address\Contracts\AddressServiceInterface;
use App\Services\ExternalConsultAddress\Contracts\ExternalConsultAddressServiceInterface;
use App\Constants\HttpStatusConstant;

class AddressService implements AddressServiceInterface
{
    /**
     * @param ExternalConsultAddressServiceInterface $externalConsultAddressService
     */
    public function __construct(private ExternalConsultAddressServiceInterface $externalConsultAddressService)
    {
        $this->externalConsultAddressService = $externalConsultAddressService;
    }

    /**
     * @param int $zipCode
     *
     * @return array
     */
    public function getAddressByZipCode(int $zipCode): array
    {
        try {
            $response = $this->externalConsultAddressService->getFullAddress($zipCode);
            $data     = new AddressResource($response);

            return ['code' => HttpStatusConstant::OK, 'data' => $data];
        } catch (Exception $exception) {
            switch (get_class($exception)) {
                case ExternalConsultAddressException::class:
                    return ['code' => $exception->getCode(), 'message' => $exception->getMessage()];
                default:
                    return [
                        'code'    => HttpStatusConstant::INTERNAL_SERVER_ERROR,
                        'message' => trans('messages.error_searching_full_address_by_zip_code'),
                    ];
            }
        }
    }
}
