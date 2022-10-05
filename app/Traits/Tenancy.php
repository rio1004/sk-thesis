<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait Tenancy{

    protected static function boot(){

        parent::boot();

        self::creating(function($model){
            $model->user_id = auth()->id();
        });

        self::addGlobalScope(function(Builder $builder){
            $builder->where('user_id', auth()->id());
        });
    }
}
