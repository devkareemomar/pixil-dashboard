<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormLanguage extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'form_builder_id', 'language_id', 'status_name', 'form_data'
    ];
}
