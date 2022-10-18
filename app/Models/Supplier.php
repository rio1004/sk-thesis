<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Tenancy;

class Supplier extends Model
{
    use HasFactory, Tenancy;

    protected $guarded = [];
}
