<?php

namespace App\Models;

use App\Traits\Visitable;

class News extends BaseModel
{
    use Visitable;

    protected $fillable = [
        'title', 'short_description', 'description', 'image', 'views', 'slug',
    ];

    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'category_news_categories', 'news_id', 'news_categories_id');
    }

    public function tags()
    {
        return $this->belongsToMany(NewsTag::class, 'tag_news_tags', 'news_id', 'news_tags_id');
    }

    public function newsLanguage()
    {
        return $this->hasMany(NewsLanguage::class);
    }

    public function currentLanguage()
    {
        return $this->newsLanguage()->where('lang_code', app()->getLocale())->first();
    }

    public function getUniqueColumns()
    {
        return ['title'];
    }
}
