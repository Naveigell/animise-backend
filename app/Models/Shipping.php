<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
class Shipping extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_REJECT = 'rejected';
    const STATUS_SEND = 'send';

    protected $fillable = ["user_id"];
}
