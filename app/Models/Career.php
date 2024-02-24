<?php

namespace App\Models;

class Career extends BaseModel
{
    protected $fillable = ['name', 'email', 'phone', 'file', 'job_category_id', 'nationality_id'];

    public function job_category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function getUniqueColumns()
    {
        return ['email', 'phone', 'file'];
    }
}
