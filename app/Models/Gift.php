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
        'order_project_id',
        'template',
        'template_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function order_project()
    {
        return $this->belongsTo(OrderProject::class,'order_project_id');
    }

    public function template()
    {
        return $this->belongsTo(GiftTemplate::class,'template_id');
    }


}
