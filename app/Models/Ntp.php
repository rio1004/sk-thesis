<?php

namespace App\Models;

use App\Traits\Tenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ntp extends Model
{
    use HasFactory, Tenancy;

    protected $guarded = [];

    protected $dates = [
        'ntp_date',
        'ntp_effectivity_date',
    ];

    public function canvass()
    {
        return $this->belongsTo(Canvass::class);
    }

}
