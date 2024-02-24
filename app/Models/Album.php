<?php

namespace App\Models;

class Album extends BaseModel
{
    protected $fillable = ['title', 'description', 'is_active'];

    public function album_language()
    {
        return $this->hasMany(AlbumLanguage::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'album_media');
    }
}
