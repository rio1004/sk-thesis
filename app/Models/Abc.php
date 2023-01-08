<?php

namespace App\Models;

use App\Traits\Tenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abc extends Model
{
    use HasFactory, Tenancy;
    protected $guarded =[];

    public function approvedBy()
    {
        return $this->belongsTo(Official::class, 'approved_by_id');
    }

    public function recommendedBy()
    {
        return $this->belongsTo(Official::class, 'recommend_by_id');
    }

    public function submittedBy()
    {
        return $this->belongsTo(Official::class, 'submitted_by_id');
    }

    public function abc_items()
    {
        return $this->hasMany(AbcItem::class);
    }

}
