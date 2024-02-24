<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends BaseModel
{
    protected $fillable = [
        'name', 'slug', 'featured', 'parent_category', 'image', 'icon'
    ];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_category');
    }

    public function childCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_category');
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn(?string $value, array $attributes) => $value ? $value : Str::slug($attributes['name'])
        );
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_category');
    }

    public function scopeDivisions($query)
    {
        return $query->whereNotNull('parent_category');
    }

    public function getUniqueColumns()
    {
        return ['name'];
    }
}
