<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HalalSource extends Model
{
    protected $table = 'halalsources';

    protected $fillable = [
        'hStatus',
        'hDescription',
        'hOrganization',
        'hUrl',
    ];

    public function ingredient()
    {
        return $this->belongsToMany('App\Models\Ingredient');
    }
}
