<?php

namespace App\Models;

class LanguageProject extends BaseModel
{
    protected $table = 'language_project';
    protected $fillable = [
        'project_id',
        'language_id',
        'name',
        'description',
        'short_description',
        'slug',
        'lang_code',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

}
