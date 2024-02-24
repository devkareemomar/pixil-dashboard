<?php

namespace App\Models;

class WidgetCategory extends BaseModel
{
    protected $fillable = ['name', 'thumbnail', 'folder_name'];

    public function templates()
    {
        return $this->hasMany(WidgetTemplate::class);
    }
}
