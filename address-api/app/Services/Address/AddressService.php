<?php

namespace App\Services\Address;

use Exception;
use App\Http\Resources\Address\AddressResource;
use App\Exceptions\ExternalConsultAddress\ExternalConsultAddressException;
use App\Services\Address\Contracts\AddressServiceInterface;
use App\Services\ExternalConsultAddress\Contracts\ExternalConsultAddressServiceInterface;
use App\Messaging\Contracts\ProducerInterface;
use App\Constants\HttpStatusConstant;
use App\Constants\TopicConstant;

class AddressService implements AddressServiceInterface
{
    /**
     * @param ExternalConsultAddressServiceInterface $externalConsultAddressService
     * @param ProducerInterface $producer
     *
     */
    public function __construct(
        private ExternalConsultAddressServiceInterface $externalConsultAddressService,
        private ProducerInterface $producer
    )
    {
        $this->externalConsultAddressService = $externalConsultAddressService;
        $this->producer                      = $producer;
    }

    /**
     * @param int $zipCode
     *
     * @return array
     */
    public function getAddressByZipCode(int $zipCode): array
    {
        try {
            $response = $this->externalConsultAddressService->getAddressByZipCode($zipCode);
            $data     = new AddressResource($response);

            $this->producer->sendMessage(
                TopicConstant::NEW_ADDRESS,
                json_encode($data)
            );

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
