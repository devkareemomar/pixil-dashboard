<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryLanguage extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'country_id',
        'language_id',
        'name',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

}
