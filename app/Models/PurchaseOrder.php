<?php

namespace App\Models;

use App\Traits\Tenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory, Tenancy;

    protected $guarded = [];

    protected $dates = [
        'po_date',
        'date_of_delivery'
    ];

    public function purchaseOrderItem()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class, 'pr_id', 'id');
    }
}
