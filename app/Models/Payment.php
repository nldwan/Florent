<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'month',
        'amount',
        'status',
        'payment_method',
        'paid_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
