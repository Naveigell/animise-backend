<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "product_id", "shipping_id", "quantity",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
}
