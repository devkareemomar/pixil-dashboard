<?php

namespace App\Models;


class AlbumMedia extends BaseModel
{
    public $timestamps = false;

    protected $fillable = ['album_id', 'media_id'];
}
