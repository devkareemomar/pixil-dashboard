<?php

namespace App\Models;

class Donation extends BaseModel
{
    protected $fillable = [
        'tag_id',
        'category_id',
        'project_id',
        'project_code',
        'transaction_id',
        'reference',
        'payment_method',
        'amount',
        'paid_amount',
        'result',
        'user_id',
        'donor_name',
        'donor_phone',
        'is_zakat',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
