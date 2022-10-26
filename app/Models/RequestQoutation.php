<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Tenancy;

class RequestQoutation extends Model
{
    use HasFactory, Tenancy;
    protected $guarded = [];
    public function procurement_officer(){
        return $this->belongsTo(Official::class, 'procurement_ofcr_id');
    }

    public function request_items(){
        return $this->hasMany(RequestQoutationItem::class, 'rfq_id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
