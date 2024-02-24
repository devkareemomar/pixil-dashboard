<?php

namespace App\Models;

class Section extends BaseModel
{
    protected $fillable = ['page_id', 'order'];

    public function widgets()
    {
        return $this->hasMany(Widget::class);
    }

}
