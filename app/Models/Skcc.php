<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skcc extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $dates = [
        'skcc_date'
    ];

    public function skccItem()
    {
        return $this->hasMany(SkccItem::class);
    }
}
