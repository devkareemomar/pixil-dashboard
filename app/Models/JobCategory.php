<?php

namespace App\Models;

use App\Traits\Filter;
use App\Traits\Sort;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class JobCategory extends Model implements Auditable
{
    use Filter, Sort;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['name'];

    public function getUniqueColumns()
    {
        return ['name'];
    }
}
