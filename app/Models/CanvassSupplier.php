<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanvassSupplier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function canvass_items(){
        return $this->hasMany(CanvassItem::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
