<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static|\Illuminate\Database\Eloquent\Builder updateOrCreate(array $attributes, array $values = [])
 */
class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "product_id", "quantity",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
