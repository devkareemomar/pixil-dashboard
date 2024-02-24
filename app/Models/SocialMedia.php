<?php

namespace App\Models;

use App\Traits\Filter;
use App\Traits\Sort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    use Filter;
    use Sort;

    protected $table = 'social_medias';

    protected $fillable = [
        'name',
        'icon',
        'url',
    ];

    public function getUniqueColumns()
    {
        return ['name'];
    }
}
