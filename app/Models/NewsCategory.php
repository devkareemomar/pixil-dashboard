<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class NewsCategory extends BaseModel
{
    protected $fillable = [
        'name', 'slug', 'featured', 'image', 'icon'
    ];

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
