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
     * @param int $zipCode
     *
     * @return Factory
     */
    public function zipCode(int $zipCode): Factory
    {
        return $this->state(function (array $attributes) use($zipCode) {
            return [
                'zip_code' => $zipCode,
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'zip_code'     => $this->faker->numberBetween(11111111, 99999999),
            'street'       => $this->faker->streetName(),
            'complement'   => $this->faker->sentence(3),
            'neighborhood' => $this->faker->sentence(2),
            'city'         => $this->faker->city(),
            'state'        => $this->faker->stateAbbr(),
        ];
    }
}
