<?php

namespace App\Traits;

use App\Models\Official;

trait HasRequestedBy
{
    public function requestedBy()
    {
        return $this->belongsTo(Official::class, 'requested_by_id');
    }
}
