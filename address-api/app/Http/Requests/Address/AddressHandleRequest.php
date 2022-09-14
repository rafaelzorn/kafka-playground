<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\Base\BaseFormRequest;

class AddressHandleRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'zip_code' => 'required|integer|min_digits:8|max_digits:8',
        ];
    }
}
