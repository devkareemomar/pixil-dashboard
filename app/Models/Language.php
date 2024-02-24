<?php

namespace App\Models;

class Language extends BaseModel
{
    protected $fillable = [
        'name', 'short_name', 'flag', 'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($language) {
            if ($language->is_default) {
                Language::where('is_default', true)->update(['is_default' => false]);
            }


            Menu::create([
                'name' => 'Menu Header ' . $language->short_name,
                'position' => 'header',
                'locale' => $language->short_name
            ]);

            Menu::create([
                'name' => 'Menu Header ' . $language->short_name,
                'position' => 'footer',
                'locale' => $language->short_name
            ]);
        });

        static::updating(function ($language) {
            if ($language->is_default) {
                Language::where('is_default', true)->update(['is_default' => false]);
            }

        });

        static::deleting(function ($language) {
            if ($language->is_default) {
                $anotherLanguage = Language::where('id', '!=', $language->id)->first();
                if ($anotherLanguage) {
                    $anotherLanguage->is_default = true;
                    $anotherLanguage->save();
                }
            }

            Menu::where('locale', $language->short_name)->delete();
        });
    }

    public function getUniqueColumns()
    {
        return ['name', 'short_name'];
    }
}
