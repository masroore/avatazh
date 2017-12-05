<?php

namespace App;

use App\BaseModel;

/**
 * @property mixed name
 * @property array|integer cost
 * @property array|string cost_per
 * @property array|string plan
 * @property array|boolean status
 * @property array|boolean featured
 * @property array|integer pricing_order
 */
class Package extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('pricing_order');
    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        return $this->attributes['status'] ? 'active' : 'inactive';
    }

    /**
     * @return string
     */
    public function getFeaturedAttribute()
    {
        return $this->attributes['featured'] ? 'featured' : 'normal';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class)->withPivot('spec')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
