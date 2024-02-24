<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLanguage extends BaseModel
{
    protected $fillable = [
        'news_id',
        'language_id',
        'title',
        'description',
        'short_description',
        'lang_code'
    ];
}
