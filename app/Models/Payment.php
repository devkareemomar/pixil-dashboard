<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = ['user_id', 'currency', 'charge_id', 'payment_channel', 'amount', 'order_id', 'status', 'metadata', 'payment_method','created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function metadata(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
        );
    }
}
