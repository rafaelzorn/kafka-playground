<?php

namespace Tests\Unit\app\Repositories\Address;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\AddressHelper;
use App\Repositories\Address\Contracts\AddressRepositoryInterface;
use App\Models\Address;

class AddressRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var AddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->addressRepository = $this->app->make(AddressRepositoryInterface::class);
    }

    /**
     * @test
     *
     * @return void
     */
    public function should_create_a_new_address(): void
    {
        // Arrange
        $data = AddressHelper::addressFaker();

        // Act
        $address = $this->addressRepository->updateOrCreate(['zip_code' => $data['zip_code']], $data);

        dd($address);
    }
}
