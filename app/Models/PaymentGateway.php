<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentGateway extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status', 'api_key', 'secret_key'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($paymentGateway) {
            if ($paymentGateway->status) {
                PaymentGateway::where('status', 1)->update(['status' => 0]);
            }
        });

        static::updating(function ($paymentGateway) {
            if ($paymentGateway->status) {
                PaymentGateway::where('status', 1)->update(['status' => 0]);
            }
        });
    }
}
