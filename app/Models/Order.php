<?php

namespace App\Models;

use App\Traits\Filter;
use App\Traits\Sort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    use Sort;
    use Filter;

    protected $fillable = ['code', 'user_id', 'amount', 'tax_amount', 'sub_total', 'description', 'status',
        'name','email', 'phone', 'created_at', 'updated_at','payment_type'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
