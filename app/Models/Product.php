<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method \Illuminate\Database\Eloquent\Builder|static inRandomOrder($seed = '')
 * @method \Illuminate\Database\Eloquent\Builder|static find($id, $columns = ['*'])
 * @method \Illuminate\Database\Eloquent\Builder|static search(string $value)
 * @method \Illuminate\Database\Eloquent\Builder|static stockAvailable()
 */
class Product extends Model
{
    use HasFactory;

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('storage/images/products/' . $this->attributes['image']);
    }

    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */
    public function scopeSearch($query, $value)
    {
        return $query->where('name', 'LIKE', "%{$value}%");
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeStockAvailable($query)
    {
        return $query->where('stock', '>', 0);
    }
}
