<?php

namespace App\Http\Controllers\Api\V1\Address;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Address\AddressHandleRequest;

class AddressController extends Controller
{
    /**
     * @return void
     */
    public function __construct() {}

    /**
     * @param AddressHandleRequest $request
     *
     * @return JsonResponse
     */
    public function handle(AddressHandleRequest $request): JsonResponse
    {
        // TODO
    }
}
