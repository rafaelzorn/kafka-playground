<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'zip_code'     => '',
            'street'       => '',
            'complement'   => '',
            'neighborhood' => '',
            'city'         => '',
            'state'        => '',
        ];
    }
}
