<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gift extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'sender_name',
        'sender_email',
        'recipient_name',
        'recipient_email',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
