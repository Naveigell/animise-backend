<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Query\Builder
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PaymentProductOrder extends Model
{
    use HasFactory;

    protected $table = 'payment_product_order';

    protected $fillable = ['user_id', 'product_order_id', 'payment_id'];
}
