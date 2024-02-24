<?php

namespace App\Models;

class LanguageCampaign extends BaseModel
{
    protected $table = 'campaign_language';
    protected $fillable = [
        'campaign_id',
        'language_id',
        'title',
        'description',
        'slogan'
    ];

}
