<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param array $fieldsValidations
     *
     * @return string $messages
     */
    public function validationMessages(array $fieldsValidations): string
    {
        $messages = [];

        foreach ($fieldsValidations as $key => $fieldValidations) {
            foreach ($fieldValidations as $validation) {
                $attribute = str_replace('_', ' ', $key);
                $message   = str_replace(':attribute', $attribute, trans($validation));

                $messages[$key][] = $message;
            }
        }

        $messages = json_encode($messages);

        return $messages;
    }
}
