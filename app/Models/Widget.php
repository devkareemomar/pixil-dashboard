<?php

namespace App\Models;

class Widget extends BaseModel
{
    protected $fillable = ['section_id', 'widget_category_id', 'name', 'thumbnail', 'payload', 'order', 'size_percentage'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function category()
    {
        return $this->belongsTo(WidgetCategory::class);
    }

    protected function payload(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => json_encode($value),
        );
    }
}

