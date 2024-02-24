<?php

namespace App\Models;

class Contact extends BaseModel
{
    protected $fillable = ['name', 'email', 'phone', 'message', 'subject'];
}
