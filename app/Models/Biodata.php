<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static|\Illuminate\Database\Eloquent\Builder where($column, $operator = null, $value = null, $boolean = 'and')
 */
class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        "phone", "address", "avatar"
    ];
}
