<?php

namespace App\Models;

use App\Traits\Visitable;

class Page extends BaseModel
{
    use Visitable;

    protected $fillable = ['project_id', 'name', 'title', 'description', 'metadata'];

    public function getUniqueColumns()
    {
        return ['name'];
    }
}
