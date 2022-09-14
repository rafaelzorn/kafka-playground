<?php

namespace App\Http\Controllers\Api\V1\Address;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Address\AddressHandleRequest;
use App\Services\Address\Contracts\AddressServiceInterface;

class AddressController extends Controller
{
    /**
     * @param AddressServiceInterface $addressService
     */
    public function __construct(private AddressServiceInterface $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * @param AddressHandleRequest $request
     *
     * @return JsonResponse
     */
    public function handle(AddressHandleRequest $request): JsonResponse
    {
        $response = $this->addressService->getAddressByZipCode($request->zip_code);

        return $this->responseAdapter($response);
    }
}
