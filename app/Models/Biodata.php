<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @method static|\Illuminate\Database\Eloquent\Builder where($column, $operator = null, $value = null, $boolean = 'and')
 */
class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        "phone", "address", "avatar"
    ];

    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return null;
        }

        return asset('storage/images/avatars/' . $this->avatar);
    }

    public function setAvatarAttribute($file)
    {
        $name = \Str::random(30) . uniqid() . date('dmYHis') . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('public/images/avatars', $file, $name);

        $this->attributes['avatar'] = $name;
    }
}
