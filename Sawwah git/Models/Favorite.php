<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'country_id',
        'country_name',
        'cost',
        'weather',
        'language',
        'type',
        'description',
    ];

   
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

