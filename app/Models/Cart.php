<?php

namespace App\Models;

use App\Traits\Filter;
use App\Traits\Sort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;

class Cart extends Model implements Auditable
{
    use Filter;
    use Sort;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'session_id',
        'total_amount',
        'client_notes',
        'admin_notes',
        'is_paid',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class)->withPivot('amount', 'gifted_to_email', 'gifted_to_phone', 'gifted_to_name');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalAmountAttribute($value)
    {
        return $this->projects->sum('pivot.amount');
    }
}
