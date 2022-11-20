<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanvassItem extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function canvass_suppliers(){
        return $this->hasMany(CanvassSupplier::class, 'canvass_item_id');
    }
}
