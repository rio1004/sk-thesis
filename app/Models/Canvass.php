<?php

namespace App\Models;

use App\Traits\Tenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canvass extends Model
{
    use HasFactory,Tenancy;

    protected $guarded = [];

    public function canvass_suppliers()
    {
        return $this->hasMany(CanvassSupplier::class, 'canvass_id');
    }

    public function canvass_items()
    {
        return $this->hasMany(CanvassItem::class, 'canvass_id');
    }

}
