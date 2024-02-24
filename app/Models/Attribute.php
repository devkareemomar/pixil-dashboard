<?php

namespace App\Models;



class Attribute extends BaseModel
{
    protected $fillable = ['title', 'input_type_id', 'min_quantity', 'max_quantity', 'desktop_visibility', 'tablet_visibility', 'mobile_visibility', 'has_order'];

    public function inputType()
    {
        return $this->belongsTo(InputType::class);
    }

}
