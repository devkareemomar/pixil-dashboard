<?php

namespace App\Models;

use App\Traits\Filter;

class ProjectStatus extends BaseModel
{
    use Filter;
    protected $fillable = [
        'name', 'description', 'color', 'is_new', 'is_completed', 'is_active'
    ];

    public function getUniqueColumns()
    {
        return ['name'];
    }
}
