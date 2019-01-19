<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = 'ingredients';

    protected $fillable = [
        'iName',
        'iType',
        'eNumber',
    ];

    protected $guarded = ['id'];

    public function foodProduct()
    {
        return $this->belongsToMany('App\Models\FoodProduct');
    }

    public function halalSource()
    {
        return $this->belongsToMany('App\Models\HalalSource','ingredient_halal','ingredient_id', 'halal_id')->withTimestamps();
    }
}
