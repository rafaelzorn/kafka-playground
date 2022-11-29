<?php

namespace Tests\Helpers;

use Faker\Factory;

class AddressHelper
{
    /**
     * @param mixed $zipCode
     *
     * @return array
     */
    public static function addressFaker(mixed $zipCode = false): array
    {
        $faker = Factory::create();

        if (!$zipCode) {
            $zipCode = $faker->numberBetween(11111111, 99999999);
        }

        return [
            'zip_code'     => $zipCode,
            'street'       => $faker->streetName(),
            'complement'   => $faker->sentence(3),
            'neighborhood' => $faker->sentence(2),
            'city'         => $faker->city(),
            'state'        => $faker->stateAbbr(),
        ];
    }
}
