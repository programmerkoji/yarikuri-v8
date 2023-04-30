<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMonth extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'month_id',
        'is_checked',
    ];
}
