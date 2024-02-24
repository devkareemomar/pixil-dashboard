<?php

namespace App\Models;

class HelpList extends BaseModel
{
    protected $fillable = [
        'nationality_id',
        'service_status',
        'gender',
        'marital_status',
        'name',
        'civil_id',
        'help_type_id',
        'family_members',
        'job',
        'salary',
        'address',
        'other_information',
        'phone',
        'file',
        'old_help_document',
        'reference_no',
    ];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function help_type()
    {
        return $this->belongsTo(HelpType::class, 'help_type_id');
    }
}
