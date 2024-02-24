<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyLanguage extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'currency_id',
        'language_id',
        'name',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
