<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'zip_code'     => $this['cep'],
            'street'       => $this['logradouro'],
            'complement'   => $this['complemento'],
            'neighborhood' => $this['bairro'],
            'city'         => $this['localidade'],
            'state'        => $this['uf'],
        ];
    }
}
