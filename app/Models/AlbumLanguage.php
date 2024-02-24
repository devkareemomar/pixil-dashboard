<?php

namespace App\Models;


class AlbumLanguage extends BaseModel
{
    public $timestamps = false;
    protected $fillable = ['album_id', 'language_id', 'title', 'description'];
}
