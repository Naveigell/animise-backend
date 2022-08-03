<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 * @method \Illuminate\Database\Eloquent\Builder|static stockAvailable()
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'image', 'name', 'description', 'price', 'stock', 'release_date', 'estimated_date', 'pre_order',
    ];

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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = \Str::slug($value) . '-' . ($this->id ?? uniqid());
    }

    /**
     * @param UploadedFile $file
     */
    public function setImageAttribute($file)
    {
        $name = \Str::random(30) . uniqid() . date('dmYHis') . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('public/images/products', $file, $name);

        $this->attributes['image'] = $name;
    }
}
