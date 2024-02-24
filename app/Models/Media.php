<?php

namespace App\Models;

class Media extends BaseModel
{
    public $timestamps = false;

    protected $fillable = ['video', 'image'];
}
