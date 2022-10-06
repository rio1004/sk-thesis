<?php

namespace App\Models;

use App\Traits\HasRequestedBy;
use App\Traits\Tenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory, Tenancy,HasRequestedBy;

    protected $guarded = [];

    public function purchaseRequestItem()
    {
        return $this->hasMany(PurchaseRequestItem::class);
    }

}
