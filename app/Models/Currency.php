<?php

namespace App\Models;

class Currency extends BaseModel
{
    protected $fillable = [
        'name', 'code', 'is_default', 'exchange_rate'
    ];


    // if deleting a currency, and it's the default currency, make another currency the default
    public static function boot()
    {
        parent::boot();

        static::creating(function ($currency) {
            if ($currency->is_default) {
                Currency::where('is_default', true)->update(['is_default' => false]);
            }
        });

        static::updating(function ($currency) {
            if ($currency->is_default) {
                Currency::where('is_default', true)->update(['is_default' => false]);
            }
        });

        static::deleting(function ($currency) {
            if ($currency->is_default) {
                $anotherCurrency = Currency::where('id', '!=', $currency->id)->first();
                if ($anotherCurrency) {
                    $anotherCurrency->is_default = true;
                    $anotherCurrency->save();
                }
            }
        });
    }
    public function currencyLanguage()
    {
        return $this->hasMany(CurrencyLanguage::class);
    }

    public function getUniqueColumns()
    {
        return ['name', 'code'];
    }
}
