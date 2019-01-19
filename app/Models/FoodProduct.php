<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodProduct extends Model
{
    protected $table = 'foodproducts';

    protected $fillable = [
        'fCode',
        'fName',
        'fManufacture',
        'fVerify',
        'fView',

        'weight',
        'calories',
        'totalFat',
        'saturatedFat',
        'transFat',
        'cholesterol',
        'sodium',
        'totalCarbohydrates',
        'dietaryFiber',
        'sugar',
        'protein',
        'vitaminA',
        'vitaminC',
        'calcium',
        'iron',

        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function ingredient()
    {
        return $this->belongsToMany('App\Models\Ingredient','foodproduct_ingredient','foodProduct_id')->withTimestamps();
    }

    public function certificate()
    {
        return $this->belongsToMany('App\Models\Certificate','foodproduct_certificate','foodProduct_id')->withTimestamps();
    }

    public function getIngredientListAttribute()
    {
        if (count($this->ingredients)) return $this->ingredients->lists('id')->toArray();
    }

    public function getCertificateListAttribute()
    {
        if(count($this->certificates)) return $this->certificates->lists('ccode')->toArray();
    }
}
