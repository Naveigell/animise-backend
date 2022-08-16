<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 * @property \Illuminate\Database\Eloquent\Collection $payments
 * @property \Illuminate\Database\Eloquent\Collection $productOrders
 * @property \Illuminate\Database\Eloquent\Collection $users
 */
class Shipping extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESS = 'process';
    const STATUS_REJECT = 'rejected';
    const STATUS_SEND = 'send';

    protected $fillable = ["user_id", "status"];

    public function productOrders()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
