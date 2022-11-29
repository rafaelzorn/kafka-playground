<?php

namespace App\Models;

use App\Models\BaseModel;

class Address extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'zip_code',
        'street',
        'complement',
        'neighborhood',
        'city',
        'state',
    ];

     /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'zip_code'     => 'integer',
        'street'       => 'string',
        'complement'   => 'string',
        'neighborhood' => 'string',
        'city'         => 'string',
        'state'        => 'string',
        'created_at'   => 'datetime:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s',
        'deleted_at'   => 'datetime:Y-m-d H:i:s',
    ];
}
