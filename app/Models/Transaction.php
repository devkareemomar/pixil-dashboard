<?php

namespace App\Models;

class Transaction extends BaseModel
{
    protected $fillable = [
        'category_id',
        'tag_id',
        'continent',
        'country_id',
        'project_id',
        'project_code',
        'price',
        'quantity',
        'amount',
        'comment',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
