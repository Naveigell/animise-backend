<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Banner
 * @package App\Models
 * @property string $image
 */
class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
    ];

    public function getImageUrlAttribute()
    {
        return asset('storage/images/banners/' . $this->image);
    }

    /**
     * @param UploadedFile $file
     */
    public function setImageAttribute($file)
    {
        $name = \Str::random(30) . uniqid() . date('dmYHis') . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('public/images/banners', $file, $name);

        $this->attributes['image'] = $name;
    }
}
