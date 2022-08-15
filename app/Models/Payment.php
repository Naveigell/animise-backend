<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
class Payment extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';

    protected $fillable = ['shipping_id', 'proof', 'status'];

    public function setProofAttribute($file)
    {
        $name = \Str::random(30) . uniqid() . date('dmYHis') . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('public/images/payments', $file, $name);

        $this->attributes['proof'] = $name;
    }
}
