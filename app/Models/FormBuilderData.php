<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormBuilderData extends BaseModel
{
    use HasFactory;
    protected $fillable=[
        'form_builder_id','price','checks_date','status','national_id','data'
    ];

    public function form()
    {
        return $this->belongsTo(FormBuilder::class,'form_builder_id','id');
    }
}
