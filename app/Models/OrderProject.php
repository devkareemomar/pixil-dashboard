<?php

namespace App\Models;

use App\Traits\Filter;
use App\Traits\Sort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProject extends Model
{
    use HasFactory;
    use Filter;
    use Sort;


    protected $fillable = ['order_id', 'project_id', 'qty', 'price', 'tax_amount',
     'created_at', 'updated_at','name','email','phone','comment'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function category()
    {
        return $this->project?->category;
    }
}
