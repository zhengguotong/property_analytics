<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'guid',
        'suburb',
        'state',
        'country',
    ];

    /**
     * Get the analytics for the property
     */
    public function analytics()
    {
        return $this->hasMany('App\PropertyAnalytic');
    }

    /**
    * Scope a query to only include properties of a given suburb.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @param  mixed  $suburb
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeOfSuburb($query, $suburb)
    {
        return $query->where('suburb', $suburb);
    }
}
