<?php

namespace App\Models;

class CartProject extends BaseModel
{
    protected $fillable = [
        'cart_id',
        'project_id',
        'amount',
        'gifted_to_email',
        'gifted_to_phone',
        'gifted_to_name',
    ];

}
