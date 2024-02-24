<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class NewsTag extends BaseModel
{
    protected $fillable = ['name', 'slug'];

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn(?string $value, array $attributes) => $value ? $value : Str::slug($attributes['name'])
        );
    }

    public function getUniqueColumns()
    {
        return ['name'];
    }
}
