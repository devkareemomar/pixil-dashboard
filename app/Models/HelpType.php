<?php

namespace App\Models;

class HelpType extends BaseModel
{
    protected $fillable = ['name', 'is_active'];

    public function getUniqueColumns()
    {
        return ['name'];
    }
}
