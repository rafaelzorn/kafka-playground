<?php

namespace Tests\Integration\app\Http\Controllers\Api\V1\Address\AddressController;

use Tests\TestCase;
use Exception;
use Mockery\MockInterface;
use App\Constants\HttpStatusConstant;
use App\Services\ExternalConsultAddress\Contracts\ExternalConsultAddressServiceInterface;
use App\Services\Address\Contracts\AddressServiceInterface;
use App\Exceptions\ExternalConsultAddress\ExternalConsultAddressException;
use App\Http\Resources\Address\AddressResource;

class HandleTest extends TestCase
{
    private const ENDPOINT = '/api/v1/address';

    /**
     * @test
     *
     * @return void
     */
    public function should_return_full_address(): void
    {
        // Arrange
        $zipCode      = 93425170;
        $responseData = $this->responseData();

        $dataResource = new AddressResource($responseData);

        $this->mock(ExternalConsultAddressServiceInterface::class, function (MockInterface $mock) use ($responseData) {
            $mock->shouldReceive('getAddressByZipCode')->once()->andReturn($responseData);
        });

        // Act
        $response = $this->postJson(self::ENDPOINT, ['zip_code' => $zipCode]);

        // Assert
        $response->assertStatus(HttpStatusConstant::OK);
        $response->assertExactJson([
            'code' => HttpStatusConstant::OK,
            'data' => $dataResource->resolve(),
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function should_return_not_found_address(): void
    {
        // Arrange
        $zipCode = 12345678;

        $this->mock(ExternalConsultAddressServiceInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('getAddressByZipCode')->andThrow(new ExternalConsultAddressException(
                trans('messages.address_not_found_by_zip_code'),
                HttpStatusConstant::NOT_FOUND,
            ));
        });

        // Act
        $response = $this->postJson(self::ENDPOINT, ['zip_code' => $zipCode]);

        // Assert
        $response->assertStatus(HttpStatusConstant::NOT_FOUND);
        $response->assertExactJson([
            'code'    => HttpStatusConstant::NOT_FOUND,
            'message' => trans('messages.address_not_found_by_zip_code'),
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function should_return_validation_zip_code_required(): void
    {
        // Act
        $response = $this->postJson(self::ENDPOINT);

        $validations = [
            'zip_code' => [
                trans('validation.required'),
            ],
        ];

        // Assert
        $response->assertStatus(HttpStatusConstant::UNPROCESSABLE_ENTITY);
        $this->assertEquals($this->validationMessages($validations), $response->getContent());
    }

    /**
     * @test
     *
     * @return void
     */
    public function should_return_validation_that_zip_code_must_be_an_integer(): void
    {
        // Arrange
        $zipCode  = 'a34b51c0';

        $validations = [
            'zip_code' => [
                trans('validation.integer'),
                trans('validation.min_digits', ['min' => 8, 'attribute' => 'zip code']),
                trans('validation.max_digits', ['max' => 8, 'attribute' => 'zip code']),
            ],
        ];

        // Act
        $response = $this->postJson(self::ENDPOINT, ['zip_code' => $zipCode]);

        // Assert
        $response->assertStatus(HttpStatusConstant::UNPROCESSABLE_ENTITY);
        $this->assertEquals($this->validationMessages($validations), $response->getContent());
    }

    /**
     * @test
     *
     * @return void
     */
    public function should_return_validation_of_minimum_digits_of_the_zip_code(): void
    {
        // Arrange
        $zipCode  = 123;

        $validations = [
            'zip_code' => [
                trans('validation.min_digits', ['min' => 8, 'attribute' => 'zip code']),
            ],
        ];

        // Act
        $response = $this->postJson(self::ENDPOINT, ['zip_code' => $zipCode]);

        // Assert
        $response->assertStatus(HttpStatusConstant::UNPROCESSABLE_ENTITY);
        $this->assertEquals($this->validationMessages($validations), $response->getContent());
    }

    /**
     * @test
     *
     * @return void
     */
    public function should_return_validation_of_maximum_digits_of_the_zip_code(): void
    {
        // Arrange
        $zipCode  = 123456789;

        $validations = [
            'zip_code' => [
                trans('validation.max_digits', ['max' => 8, 'attribute' => 'zip code']),
            ],
        ];

        // Act
        $response = $this->postJson(self::ENDPOINT, ['zip_code' => $zipCode]);

        // Assert
        $response->assertStatus(HttpStatusConstant::UNPROCESSABLE_ENTITY);
        $this->assertEquals($this->validationMessages($validations), $response->getContent());
    }

    private function responseData()
    {
        return [
            "cep"         => "93425-170",
            "logradouro"  => "Rua Monte Castelo",
            "complemento" => "",
            "bairro"      => "Santo Afonso",
            "localidade"  => "Novo Hamburgo",
            "uf"          => "RS",
            "ibge"        => "4313409",
            "gia"         => "",
            "ddd"         => "51",
            "siafi"       => "8771",
        ];
    }
}
