<?php

namespace App\Models;

use App\Traits\Tenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noa extends Model
{
    use HasFactory,Tenancy;

    protected $guarded = [];

    protected $dates = [
        'noa_date',
        'bid_date'
    ];

    public function canvass()
    {
        return $this->belongsTo(Canvass::class);
    }
}
