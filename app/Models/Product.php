<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static|\Illuminate\Database\Eloquent\Builder inRandomOrder($seed = '')
 * @method static|\Illuminate\Database\Eloquent\Builder find($id, $columns = ['*'])
 */
class Product extends Model
{
    use HasFactory;

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('storage/images/products/' . $this->attributes['image']);
    }
}
