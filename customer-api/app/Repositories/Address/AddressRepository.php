<?php

namespace App\Repositories\Address;

use App\Repositories\Base\BaseRepository;
use App\Repositories\Address\Contracts\AddressRepositoryInterface;
use App\Models\Address;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    /**
     * @param Address $address
     *
     * @return void
     */
    public function __construct(Address $address)
    {
        $this->model = $address;
    }
}
