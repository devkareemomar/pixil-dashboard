<?php

namespace App\Models;

class InputType extends BaseModel
{
    protected $fillable = ['name'];

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
