<?php

namespace App\Models;

use App\Traits\Tenancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory, Tenancy;

    protected $guarded = [];


}
