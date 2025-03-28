<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'month',
        'user_id',
    ];

    public function items()
    {
        return $this
            ->belongsToMany(Item::class, 'item_months')
            ->withPivot('is_checked');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
