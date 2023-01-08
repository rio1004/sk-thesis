<?php

namespace App\Models;

use App\Traits\Tenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory, Tenancy;

    protected $guarded = [];

    protected $dates = [
        'dv_date', 'or_date', 'check_date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'payee_id');
    }

    public function disbursementItem()
    {
        return $this->hasMany(DisbursementItem::class);
    }

    public function skcc()
    {
        return $this->hasOne(Skcc::class);
    }

}
