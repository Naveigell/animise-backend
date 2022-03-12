<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @method static|\Illuminate\Database\Eloquent\Builder inRandomOrder($seed = '')
 * @method static|\Illuminate\Database\Eloquent\Builder find($id, $columns = ['*'])
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'image', 'name', 'description', 'price', 'stock', 'release_date', 'estimated_date',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('storage/images/products/' . $this->attributes['image']);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = \Str::slug($value) . '-' . ($this->id ?? rand(1, 10));
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
