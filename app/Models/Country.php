<?php

namespace App\Models;

class Country extends BaseModel
{
    protected $fillable = ['name', 'short_name', 'language_id', 'currency_id', 'flag'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function countryLanguage()
    {
        return $this->hasMany(CountryLanguage::class);
    }
    public function getUniqueColumns()
    {
        return ['name', 'short_name'];
    }
}
