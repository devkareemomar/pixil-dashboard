<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormBuilder extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'status_name', 'active', 'form_data', 'locale'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function formLanguage()
    {
        return $this->hasMany(FormLanguage::class);
    }
    public function formData()
    {
        return $this->hasMany(FormBuilderData::class);
    }
}
