<?php

namespace Tests\Unit\app\Repositories\Address;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
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

        // Assert
        $address = Arr::except($address->toArray(), ['id']);

        $this->assertEquals($this->addressRepository->count(), 1);
        $this->assertEquals($data, $address);
    }

    /**
     * @test
     *
     * @return void
     */
    public function should_update_a_address(): void
    {
        // Arrange
        $dataToUpdate = AddressHelper::addressFaker(93115440);
        $data         = Address::factory()->zipCode(93115440)->create();

        // Act
        $address = $this->addressRepository
                    ->updateOrCreate(['zip_code' => $dataToUpdate['zip_code']], $dataToUpdate);

        // Assert
        $address = Arr::except($address->toArray(), ['id']);

        $this->assertEquals($this->addressRepository->count(), 1);
        $this->assertEquals($dataToUpdate, $address);
    }
}
