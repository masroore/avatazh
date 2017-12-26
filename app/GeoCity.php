<?php

namespace App;

use App\BaseModel;

class GeoCity extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $table = 'geo_cities';
}