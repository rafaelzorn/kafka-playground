<?php

namespace Tests\Helpers;

use Faker\Factory;

class AddressHelper
{
    /**
     * @return array
     */
    public static function addressFaker(): array
    {
        $faker = Factory::create();

        return [
            'zip_code'     => $faker->numberBetween(11111111, 99999999),
            'street'       => $faker->streetName(),
            'complement'   => $faker->sentence(3),
            'neighborhood' => $faker->sentence(2),
            'city'         => $faker->city(),
            'state'        => $faker->stateAbbr(),
        ];
    }
}
