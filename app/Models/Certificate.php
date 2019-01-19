<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';

    protected $fillable = [
        'cCode',
        'cExpires',
        'cStatus',
        'cOrganization'
    ];

    protected $guarded = ['id'];

    protected $dates =['cExpire'];

    public function foodProduct()
    {
        return $this->belongsToMany('App\Models\FoodProduct');
    }
}
